// ============================================================
// Config
// ============================================================
const CONFIG = {
    starCount: 150,
    starMinRadius: 0.8,
    starMaxRadius: 2.5,
    starOpacityMin: 0.3,
    starOpacityMax: 0.7,
    blueStarChance: 0.2,

    driftSpeed: 0.2,
    driftVariation: 0.1,
    phaseSpeed: 0.002,

    damping: 0.92,
    velocityCap: 2.5,
    momentumTransfer: 0.3,
    resetThreshold: 0.01,
    resetDelay: 300,

    mouseRadius: 200,
    springStrength: 0.06,
    springDamping: 0.88,
    maxPullSpeed: 1,
    growthMultiplier: 2.5,
    brightnessMultiplier: 0.8,
    mouseSmoothness: 0.12,
    maxMouseSpeed: 5,

    connectionDistance: 120,
    connectionOpacity: 0.5,
    connectionBrightness: 2,
    connectionLineWidth: 0.5,

    glowMultiplier: 3,
    glowMultiplierNear: 6,
    sparkleSpeedMin: 0.02,
    sparkleSpeedMax: 0.04,
    sparkleIntensity: 0.4,
    rayCount: 4,
    rayIntensity: 0.25,

    mouseGlowOpacity: 0.05,
    mouseGlowColor: '100, 149, 237',

    backgroundColor: '#0f172a',

    sparkleCount: 30,
    sparkleMinRadius: 0.3,
    sparkleMaxRadius: 0.8,
    sparkleOpacityMin: 0.2,
    sparkleOpacityMax: 0.8,
    sparkleDriftSpeed: 0.1,

    pulseSpeedMin: 0.015,
    pulseSpeedMax: 0.04,
    pulseIntensity: 0.25,

    debug: false,
};
// ============================================================

class Starfield {
    constructor(canvasId = 'bgCanvas') {
        this.canvas = document.getElementById(canvasId);
        if (!this.canvas) {
            console.error('❌ Canvas not found!');
            return;
        }

        this.ctx = this.canvas.getContext('2d');
        this.mouseX = null;
        this.mouseY = null;
        this.mouseVX = 0;
        this.mouseVY = 0;
        this.targetMouseX = null;
        this.targetMouseY = null;
        this.prevMouseX = null;
        this.prevMouseY = null;
        this.stars = [];
        this.sparkles = [];
        this.running = true;

        this.init();
    }

    init() {
        this.resize();
        this.createStars();
        this.createSparkles();
        this.bindEvents();
        this.animate();
    }

    resize() {
        const rect = this.canvas.parentElement.getBoundingClientRect();
        this.canvas.width = rect.width || window.innerWidth;
        this.canvas.height = rect.height || window.innerHeight;
    }

    createStars() {
        this.stars = Array.from({ length: CONFIG.starCount }, () => new Star(this.canvas));
    }

    createSparkles() {
        this.sparkles = Array.from({ length: CONFIG.sparkleCount }, () => new Sparkle(this.canvas));
    }

    bindEvents() {
        // Mouse events
        document.addEventListener('mousemove', this.handleMouseMove.bind(this));
        document.addEventListener('mouseleave', this.handleMouseLeave.bind(this));

        // Resize with debounce
        let resizeTimeout;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                this.resize();
                this.createStars();
                this.createSparkles();
            }, 250);
        });
    }

    handleMouseMove(e) {
        const rect = this.canvas.getBoundingClientRect();
        const nx = e.clientX - rect.left;
        const ny = e.clientY - rect.top;

        if (this.prevMouseX !== null && this.prevMouseY !== null) {
            this.mouseVX = (nx - this.prevMouseX) * 0.15;
            this.mouseVY = (ny - this.prevMouseY) * 0.15;
            const spd = Math.hypot(this.mouseVX, this.mouseVY);
            if (spd > CONFIG.maxMouseSpeed) {
                this.mouseVX = (this.mouseVX / spd) * CONFIG.maxMouseSpeed;
                this.mouseVY = (this.mouseVY / spd) * CONFIG.maxMouseSpeed;
            }
        }
        this.prevMouseX = nx;
        this.prevMouseY = ny;
        this.targetMouseX = nx;
        this.targetMouseY = ny;
    }

    handleMouseLeave() {
        this.targetMouseX = null;
        this.targetMouseY = null;
        this.prevMouseX = null;
        this.prevMouseY = null;
        this.mouseVX = 0;
        this.mouseVY = 0;
    }

    drawMouseGlow() {
        if (this.mouseX !== null && this.mouseY !== null) {
            const ctx = this.ctx;
            const grad = ctx.createRadialGradient(this.mouseX, this.mouseY, 0, this.mouseX, this.mouseY, CONFIG.mouseRadius);
            grad.addColorStop(0, `rgba(${CONFIG.mouseGlowColor}, ${CONFIG.mouseGlowOpacity * 1.5})`);
            grad.addColorStop(0.6, `rgba(${CONFIG.mouseGlowColor}, ${CONFIG.mouseGlowOpacity})`);
            grad.addColorStop(1, `rgba(${CONFIG.mouseGlowColor}, 0)`);
            ctx.beginPath();
            ctx.arc(this.mouseX, this.mouseY, CONFIG.mouseRadius, 0, Math.PI * 2);
            ctx.fillStyle = grad;
            ctx.fill();
        }
    }

    drawConnections() {
        const ctx = this.ctx;
        for (let i = 0; i < this.stars.length; i++) {
            for (let j = i + 1; j < this.stars.length; j++) {
                const dx = this.stars[i].x - this.stars[j].x;
                const dy = this.stars[i].y - this.stars[j].y;
                const d = Math.hypot(dx, dy);
                if (d < CONFIG.connectionDistance) {
                    const near = (this.stars[i].isPulled && this.stars[i].pullForce > 0.2) ||
                        (this.stars[j].isPulled && this.stars[j].pullForce > 0.2);
                    const op = (1 - d / CONFIG.connectionDistance) * CONFIG.connectionOpacity;
                    const fo = near ? op * CONFIG.connectionBrightness : op;
                    ctx.beginPath();
                    ctx.moveTo(this.stars[i].x, this.stars[i].y);
                    ctx.lineTo(this.stars[j].x, this.stars[j].y);
                    ctx.strokeStyle = near ? `rgba(100, 149, 237, ${fo})` : `rgba(255, 255, 255, ${fo})`;
                    ctx.lineWidth = CONFIG.connectionLineWidth;
                    ctx.stroke();
                }
            }
        }
    }

    animate() {
        if (!this.running) return;

        // Smooth mouse follow
        if (this.targetMouseX !== null && this.targetMouseY !== null) {
            if (this.mouseX === null) {
                this.mouseX = this.targetMouseX;
                this.mouseY = this.targetMouseY;
            } else {
                this.mouseX += (this.targetMouseX - this.mouseX) * CONFIG.mouseSmoothness;
                this.mouseY += (this.targetMouseY - this.mouseY) * CONFIG.mouseSmoothness;
            }
        } else {
            this.mouseVX *= 0.9;
            this.mouseVY *= 0.9;
            if (Math.abs(this.mouseVX) < 0.01) this.mouseVX = 0;
            if (Math.abs(this.mouseVY) < 0.01) this.mouseVY = 0;
            if (this.mouseX !== null) {
                this.mouseX += (null - this.mouseX) * 0.05;
                if (Math.abs(this.mouseX) < 0.1) this.mouseX = null;
            }
            if (this.mouseY !== null) {
                this.mouseY += (null - this.mouseY) * 0.05;
                if (Math.abs(this.mouseY) < 0.1) this.mouseY = null;
            }
        }

        // Clear
        const ctx = this.ctx;
        ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
        ctx.fillStyle = CONFIG.backgroundColor;
        ctx.fillRect(0, 0, this.canvas.width, this.canvas.height);

        // Draw
        this.drawMouseGlow();
        this.sparkles.forEach(s => { s.update(); s.draw(ctx); });
        this.stars.forEach(s => { s.update(this.mouseX, this.mouseY, this.mouseVX, this.mouseVY); s.draw(ctx); });
        this.drawConnections();

        requestAnimationFrame(() => this.animate());
    }

    destroy() {
        this.running = false;
    }
}

// ---- Star ----
class Star {
    constructor(canvas) {
        const r = () => Math.random();
        this.x = r() * canvas.width;
        this.y = r() * canvas.height;
        this.radius = r() * (CONFIG.starMaxRadius - CONFIG.starMinRadius) + CONFIG.starMinRadius;
        this.baseRadius = this.radius;
        this.driftX = (r() - 0.5) * CONFIG.driftSpeed;
        this.driftY = (r() - 0.5) * CONFIG.driftSpeed;
        this.driftVariation = CONFIG.driftVariation;
        this.vx = 0;
        this.vy = 0;
        this.opacity = r() * (CONFIG.starOpacityMax - CONFIG.starOpacityMin) + CONFIG.starOpacityMin;
        this.baseOpacity = this.opacity;
        this.pulse = r() * Math.PI * 2;
        this.pulseSpeed = r() * (CONFIG.pulseSpeedMax - CONFIG.pulseSpeedMin) + CONFIG.pulseSpeedMin;
        this.sparkle = r() * Math.PI * 2;
        this.sparkleSpeed = r() * (CONFIG.sparkleSpeedMax - CONFIG.sparkleSpeedMin) + CONFIG.sparkleSpeedMin;
        this.color = r() > (1 - CONFIG.blueStarChance) ? 'rgba(100, 149, 237' : 'rgba(255, 255, 255';
        this.isPulled = false;
        this.pullForce = 0;
        this.phase = r() * Math.PI * 2;
        this.phaseSpeed = CONFIG.phaseSpeed;
        this.resetTimer = 0;
        this.canvas = canvas;
    }

    update(mouseX, mouseY, mouseVX, mouseVY) {
        // Natural drift
        this.phase += this.phaseSpeed;
        const dX = Math.sin(this.phase) * this.driftVariation;
        const dY = Math.cos(this.phase) * this.driftVariation;

        this.x += this.driftX + dX + this.vx;
        this.y += this.driftY + dY + this.vy;

        // Friction & clamping
        this.vx *= CONFIG.damping;
        this.vy *= CONFIG.damping;

        let spd = Math.hypot(this.vx, this.vy);
        if (spd > CONFIG.velocityCap) {
            this.vx = (this.vx / spd) * CONFIG.velocityCap;
            this.vy = (this.vy / spd) * CONFIG.velocityCap;
        }
        if (Math.abs(this.vx) < CONFIG.resetThreshold && Math.abs(this.vy) < CONFIG.resetThreshold) {
            this.vx = 0;
            this.vy = 0;
        }

        // Wrap
        const pad = 20;
        if (this.x < -pad) this.x = this.canvas.width + pad;
        if (this.x > this.canvas.width + pad) this.x = -pad;
        if (this.y < -pad) this.y = this.canvas.height + pad;
        if (this.y > this.canvas.height + pad) this.y = -pad;

        // Pulse & Sparkle
        this.pulse += this.pulseSpeed;
        this.sparkle += this.sparkleSpeed;
        const pulseFactor = Math.sin(this.pulse) * CONFIG.pulseIntensity + (1 - CONFIG.pulseIntensity);
        const sparkleFactor = Math.abs(Math.sin(this.sparkle)) * CONFIG.sparkleIntensity + (1 - CONFIG.sparkleIntensity);

        // Mouse interaction
        let dist = Infinity;
        this.isPulled = false;
        this.pullForce = 0;

        if (mouseX !== null && mouseY !== null) {
            const dx = this.x - mouseX;
            const dy = this.y - mouseY;
            dist = Math.hypot(dx, dy);
            if (dist < CONFIG.mouseRadius) {
                const prox = 1 - dist / CONFIG.mouseRadius;
                this.pullForce = prox;
                this.isPulled = true;

                const pullX = (mouseX - this.x) / dist;
                const pullY = (mouseY - this.y) / dist;

                // Spring pull
                this.vx += pullX * CONFIG.springStrength * (0.3 + 0.7 * prox);
                this.vy += pullY * CONFIG.springStrength * (0.3 + 0.7 * prox);

                // Damping
                this.vx *= (1 - (1 - CONFIG.springDamping) * prox * 0.5);
                this.vy *= (1 - (1 - CONFIG.springDamping) * prox * 0.5);

                // Mouse velocity transfer
                this.vx += mouseVX * CONFIG.momentumTransfer * (1 - 0.5 * prox);
                this.vy += mouseVY * CONFIG.momentumTransfer * (1 - 0.5 * prox);

                // Clamp pull speed
                const ps = Math.hypot(this.vx, this.vy);
                const maxSpd = CONFIG.maxPullSpeed + (1 - prox) * 1.5;
                if (ps > maxSpd) {
                    this.vx = (this.vx / ps) * maxSpd;
                    this.vy = (this.vy / ps) * maxSpd;
                }

                // Grow
                this.radius += (this.baseRadius * (1 + prox * CONFIG.growthMultiplier) - this.radius) * 0.08;
                this.opacity += (this.baseOpacity * (1 + prox * CONFIG.brightnessMultiplier) - this.opacity) * 0.08;
                this.resetTimer = 0;
            }
        }

        if (!this.isPulled) {
            this.radius += (this.baseRadius * pulseFactor - this.radius) * 0.05;
            this.opacity += (this.baseOpacity - this.opacity) * 0.05;
            this.resetTimer++;
            if (this.resetTimer > CONFIG.resetDelay) {
                this.vx *= 0.99;
                this.vy *= 0.99;
                if (Math.abs(this.vx) < CONFIG.resetThreshold * 5 && Math.abs(this.vy) < CONFIG.resetThreshold * 5) {
                    this.vx = 0;
                    this.vy = 0;
                    this.resetTimer = 0;
                }
            }
        }
    }

    draw(ctx) {
        const sf = Math.abs(Math.sin(this.sparkle)) * CONFIG.sparkleIntensity + (1 - CONFIG.sparkleIntensity);
        const near = this.isPulled && this.pullForce > 0.2;
        const gs = near ? CONFIG.glowMultiplierNear : CONFIG.glowMultiplier;
        const gr = this.radius * gs * (0.8 + sf * 0.2);
        const grad = ctx.createRadialGradient(this.x, this.y, 0, this.x, this.y, gr);

        if (near) {
            const c = this.color === 'rgba(100, 149, 237' ? '100, 149, 237' : '255, 255, 255';
            grad.addColorStop(0, `rgba(${c}, ${this.opacity * 0.8})`);
            grad.addColorStop(0.3, `rgba(${c}, ${this.opacity * 0.3})`);
            grad.addColorStop(1, `rgba(${c}, 0)`);
        } else {
            grad.addColorStop(0, `rgba(255, 255, 255, ${this.opacity * 0.4})`);
            grad.addColorStop(0.5, `rgba(255, 255, 255, ${this.opacity * 0.15})`);
            grad.addColorStop(1, 'rgba(255, 255, 255, 0)');
        }

        ctx.beginPath();
        ctx.arc(this.x, this.y, gr, 0, Math.PI * 2);
        ctx.fillStyle = grad;
        ctx.fill();

        const cr = this.radius * (0.7 + sf * 0.3);
        ctx.beginPath();
        ctx.arc(this.x, this.y, cr, 0, Math.PI * 2);
        ctx.fillStyle = near ? this.color + `, ${this.opacity * 0.9})` : `rgba(255, 255, 255, ${this.opacity * 0.8})`;
        ctx.fill();

        // Sparkle rays
        if (this.isPulled && this.pullForce > 0.5 && sf > 0.6) {
            ctx.save();
            ctx.translate(this.x, this.y);
            const rl = this.radius * 1.5 * (this.pullForce - 0.5) * 2 * sf;
            for (let i = 0; i < CONFIG.rayCount; i++) {
                const a = (i / CONFIG.rayCount) * Math.PI * 2 + this.sparkle;
                ctx.beginPath();
                ctx.moveTo(0, 0);
                ctx.lineTo(Math.cos(a) * rl, Math.sin(a) * rl);
                ctx.strokeStyle = `rgba(255, 255, 255, ${this.opacity * CONFIG.rayIntensity * sf})`;
                ctx.lineWidth = 0.3;
                ctx.stroke();
            }
            ctx.restore();
        }
    }
}

// ---- Sparkle ----
class Sparkle {
    constructor(canvas) {
        const r = () => Math.random();
        this.x = r() * canvas.width;
        this.y = r() * canvas.height;
        this.radius = r() * (CONFIG.sparkleMaxRadius - CONFIG.sparkleMinRadius) + CONFIG.sparkleMinRadius;
        this.opacity = r() * (CONFIG.sparkleOpacityMax - CONFIG.sparkleOpacityMin) + CONFIG.sparkleOpacityMin;
        this.life = r() * Math.PI * 2;
        this.speed = 0.02 + r() * 0.04;
        this.driftX = (r() - 0.5) * CONFIG.sparkleDriftSpeed;
        this.driftY = (r() - 0.5) * CONFIG.sparkleDriftSpeed;
        this.canvas = canvas;
    }

    update() {
        this.life += this.speed;
        this.opacity = Math.abs(Math.sin(this.life)) * 0.6 + 0.2;
        this.x += this.driftX;
        this.y += this.driftY;
        if (this.x < 0) this.x = this.canvas.width;
        if (this.x > this.canvas.width) this.x = 0;
        if (this.y < 0) this.y = this.canvas.height;
        if (this.y > this.canvas.height) this.y = 0;
    }

    draw(ctx) {
        const grad = ctx.createRadialGradient(this.x, this.y, 0, this.x, this.y, this.radius * 2);
        grad.addColorStop(0, `rgba(255, 255, 255, ${this.opacity * 0.6})`);
        grad.addColorStop(1, 'rgba(255, 255, 255, 0)');
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.radius * 2, 0, Math.PI * 2);
        ctx.fillStyle = grad;
        ctx.fill();
    }
}

// Auto-initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function () {
    if (document.getElementById('bgCanvas')) {
        window.starfield = new Starfield();
    }
});

// Export for use in other modules
export default Starfield;