// ============================================================
// Config
// ============================================================
const DEFAULTS = {
    selector: '.glass',
    ease: 0.12,              // how quickly the highlight follows the pointer
    idleReturn: 0.03,        // how quickly it drifts back to center when idle
    maxDpr: 2,               // cap devicePixelRatio so huge screens don't tank perf
    trackOutside: true,      // track cursor even when outside the element
    clampPosition: true,     // clamp the highlight position within the element bounds
};
// ============================================================

export default class GlassEffect {
    constructor(options = {}) {
        this.options = { ...DEFAULTS, ...options };
        this.instances = [];
        this.pointer = { x: 0, y: 0 };
        this.raf = null;
        this.ro = null;

        this.onPointerMove = this.onPointerMove.bind(this);
        this.loop = this.loop.bind(this);
    }

    mount() {
        document.querySelectorAll(this.options.selector).forEach((card) => this.attach(card));

        window.addEventListener('mousemove', this.onPointerMove);
        window.addEventListener('touchmove', this.onPointerMove, { passive: true });

        if ('ResizeObserver' in window) {
            this.ro = new ResizeObserver((entries) => {
                entries.forEach((entry) => {
                    const instance = this.instances.find((i) => i.card === entry.target);
                    if (instance) this.resize(instance);
                });
            });
            this.instances.forEach((instance) => this.ro.observe(instance.card));
        }

        if (!this.raf) this.loop();

        return this;
    }

    attach(card) {
        if (card.dataset.glassMounted === 'true') return;
        card.dataset.glassMounted = 'true';

        if (getComputedStyle(card).position === 'static') {
            card.style.position = 'relative';
        }

        let canvas = card.querySelector(':scope > canvas.glass-canvas');
        let injected = false;
        if (!canvas) {
            canvas = document.createElement('canvas');
            canvas.className = 'glass-canvas';
            card.appendChild(canvas);
            injected = true;
        }

        canvas.style.position = 'absolute';
        canvas.style.inset = '0';
        canvas.style.width = '100%';
        canvas.style.height = '100%';
        canvas.style.pointerEvents = 'none';
        canvas.style.borderRadius = 'inherit';

        const instance = {
            card,
            canvas,
            injected,
            ctx: canvas.getContext('2d'),
            width: 0,
            height: 0,
            dpr: Math.min(window.devicePixelRatio || 1, this.options.maxDpr),
            targetX: 0.5,
            targetY: 0.5,
            currentX: 0.5,
            currentY: 0.5,
            hovering: false,
            radii: { tl: 0, tr: 0, br: 0, bl: 0 },
        };

        card.addEventListener('mouseenter', () => { instance.hovering = true; });
        card.addEventListener('mouseleave', () => { instance.hovering = false; });

        this.instances.push(instance);
        this.resize(instance);
    }

    resize(instance) {
        const rect = instance.card.getBoundingClientRect();
        instance.width = rect.width;
        instance.height = rect.height;
        instance.canvas.width = Math.max(1, rect.width * instance.dpr);
        instance.canvas.height = Math.max(1, rect.height * instance.dpr);

        const computedStyle = getComputedStyle(instance.card);
        instance.radii = this.parseBorderRadius(computedStyle, instance.width, instance.height);

        instance.ctx.setTransform(instance.dpr, 0, 0, instance.dpr, 0, 0);
    }

    parseBorderRadius(computedStyle, width, height) {
        const radiusStr = computedStyle.borderRadius || '0px';

        const parts = radiusStr.split('/').map(s => s.trim());
        const horizontal = parts[0];
        const vertical = parts[1] || horizontal;

        const parseRadii = (str, dimension) => {
            const values = str.split(/\s+/).filter(s => s);

            const parsed = values.map(v => {
                if (v.includes('%')) {
                    return (parseFloat(v) / 100) * dimension;
                }
                return parseFloat(v) || 0;
            });

            if (parsed.length === 1) {
                return [parsed[0], parsed[0], parsed[0], parsed[0]];
            } else if (parsed.length === 2) {
                return [parsed[0], parsed[1], parsed[0], parsed[1]];
            } else if (parsed.length === 3) {
                return [parsed[0], parsed[1], parsed[2], parsed[0]];
            } else if (parsed.length >= 4) {
                return parsed.slice(0, 4);
            }
            return [0, 0, 0, 0];
        };

        const hRadii = parseRadii(horizontal, width);
        const vRadii = parseRadii(vertical, height);

        return {
            tl: Math.min(hRadii[0], vRadii[0], width / 2, height / 2),
            tr: Math.min(hRadii[1], vRadii[1], width / 2, height / 2),
            br: Math.min(hRadii[2], vRadii[2], width / 2, height / 2),
            bl: Math.min(hRadii[3], vRadii[3], width / 2, height / 2),
        };
    }

    onPointerMove(e) {
        const point = e.touches ? e.touches[0] : e;
        if (!point) return;
        this.pointer.x = point.clientX;
        this.pointer.y = point.clientY;
    }

    loop() {
        this.instances.forEach((instance) => this.draw(instance));
        this.raf = requestAnimationFrame(this.loop);
    }

    draw(instance) {
        const { ctx, width: w, height: h, radii } = instance;
        if (!w || !h) return;

        const rect = instance.card.getBoundingClientRect();
        const ease = instance.hovering ? this.options.ease : this.options.idleReturn;

        let toX = (this.pointer.x - rect.left) / rect.width;
        let toY = (this.pointer.y - rect.top) / rect.height;

        if (!this.options.trackOutside) {
            toX = instance.hovering
                ? Math.min(1, Math.max(0, toX))
                : 0.5;
            toY = instance.hovering
                ? Math.min(1, Math.max(0, toY))
                : 0.5;
        } else {
            if (this.options.clampPosition) {
                toX = Math.min(1, Math.max(0, toX));
                toY = Math.min(1, Math.max(0, toY));
            }
        }

        instance.currentX += (toX - instance.currentX) * ease;
        instance.currentY += (toY - instance.currentY) * ease;

        const x = instance.currentX * w;
        const y = instance.currentY * h;

        ctx.clearRect(0, 0, w, h);

        ctx.save();
        this.roundRect(ctx, 0, 0, w, h, radii);
        ctx.clip();

        const glow = ctx.createRadialGradient(x, y, 0, x, y, Math.max(w, h) * 0.5);
        glow.addColorStop(0, 'rgba(255,255,255,0.12)');
        glow.addColorStop(0.4, 'rgba(255,255,255,0.04)');
        glow.addColorStop(1, 'rgba(255,255,255,0)');
        ctx.fillStyle = glow;
        ctx.fillRect(0, 0, w, h);

        const counter = ctx.createRadialGradient(w - x, h - y, 0, w - x, h - y, Math.max(w, h) * 0.3);
        counter.addColorStop(0, 'rgba(255,255,255,0.03)');
        counter.addColorStop(1, 'rgba(255,255,255,0)');
        ctx.fillStyle = counter;
        ctx.fillRect(0, 0, w, h);

        const inset = 1.5;
        const borderGlow = ctx.createRadialGradient(x, y, 0, x, y, Math.max(w, h) * 0.5);
        borderGlow.addColorStop(0, 'rgba(255,255,255,0.35)');
        borderGlow.addColorStop(1, 'rgba(255,255,255,0)');
        ctx.strokeStyle = borderGlow;
        ctx.lineWidth = 2;

        const insetRadii = {
            tl: Math.max(0, radii.tl - inset),
            tr: Math.max(0, radii.tr - inset),
            br: Math.max(0, radii.br - inset),
            bl: Math.max(0, radii.bl - inset),
        };
        this.roundRect(ctx, inset, inset, w - inset * 2, h - inset * 2, insetRadii);
        ctx.stroke();

        ctx.restore();

        ctx.save();
        const outerGlow = ctx.createRadialGradient(x, y, 0, x, y, Math.max(w, h) * 0.6);
        outerGlow.addColorStop(0, 'rgba(255,255,255,0.08)');
        outerGlow.addColorStop(1, 'rgba(255,255,255,0)');
        ctx.fillStyle = outerGlow;
        this.roundRect(ctx, 0, 0, w, h, radii);
        ctx.fill();
        ctx.restore();
    }

    /**
     * @param {CanvasRenderingContext2D} ctx
     * @param {number} x
     * @param {number} y
     * @param {number} w
     * @param {number} h
     * @param {Object|number} radii
     */

    roundRect(ctx, x, y, w, h, radii) {
        if (typeof radii === 'number') {
            const r = Math.min(radii, w / 2, h / 2);
            ctx.beginPath();
            ctx.moveTo(x + r, y);
            ctx.lineTo(x + w - r, y);
            ctx.quadraticCurveTo(x + w, y, x + w, y + r);
            ctx.lineTo(x + w, y + h - r);
            ctx.quadraticCurveTo(x + w, y + h, x + w - r, y + h);
            ctx.lineTo(x + r, y + h);
            ctx.quadraticCurveTo(x, y + h, x, y + h - r);
            ctx.lineTo(x, y + r);
            ctx.quadraticCurveTo(x, y, x + r, y);
            ctx.closePath();
            return;
        }

        const { tl, tr, br, bl } = radii;

        const maxR = Math.min(w / 2, h / 2);
        const rtl = Math.min(tl, maxR);
        const rtr = Math.min(tr, maxR);
        const rbr = Math.min(br, maxR);
        const rbl = Math.min(bl, maxR);

        ctx.beginPath();

        ctx.moveTo(x + rtl, y);

        // Top edge
        ctx.lineTo(x + w - rtr, y);
        ctx.quadraticCurveTo(x + w, y, x + w, y + rtr);

        // Right edge
        ctx.lineTo(x + w, y + h - rbr);
        ctx.quadraticCurveTo(x + w, y + h, x + w - rbr, y + h);

        // Bottom edge
        ctx.lineTo(x + rbl, y + h);
        ctx.quadraticCurveTo(x, y + h, x, y + h - rbl);

        ctx.lineTo(x, y + rtl);
        ctx.quadraticCurveTo(x, y, x + rtl, y);

        ctx.closePath();
    }

    destroy() {
        if (this.raf) cancelAnimationFrame(this.raf);
        this.raf = null;

        window.removeEventListener('mousemove', this.onPointerMove);
        window.removeEventListener('touchmove', this.onPointerMove);
        this.ro?.disconnect();
        this.ro = null;

        this.instances.forEach((instance) => {
            if (instance.injected) {
                instance.canvas.remove();
            } else {
                instance.ctx.clearRect(0, 0, instance.canvas.width, instance.canvas.height);
            }
            delete instance.card.dataset.glassMounted;
        });
        this.instances = [];
    }
}