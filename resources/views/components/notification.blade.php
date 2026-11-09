@props([
    'message' => null,
    'type' => 'success',
    'duration' => 4000,
])

@php
    $colors = [
        'success' => 'border-emerald-400/30 bg-emerald-500/15 text-emerald-200',
        'error'   => 'border-red-400/30 bg-red-500/15 text-red-200',
        'info'    => 'border-blue-400/30 bg-blue-500/15 text-blue-200',
        'warning' => 'border-yellow-400/30 bg-yellow-500/15 text-yellow-200',
    ];
    $icons = [
        'success' => 'correct',
        'error'   => 'important',
        'info'    => 'important',
        'warning' => 'important',
    ];
@endphp

<div
    x-data="{
        show: false,
        message: @js($message),
        type: @js($type),
        duration: {{ $duration }},
        init() {
            window.addEventListener('notify', (e) => {
                this.message = e.detail.message;
                this.type = e.detail.type || 'success';
                this.show = true;
                this.scheduleHide();
            });

            // If a message was passed directly at render time, show it
            if (this.message) {
                this.show = true;
                this.scheduleHide();
            }
        },
        scheduleHide() {
            if (this.duration > 0) {
                clearTimeout(this.timer);
                this.timer = setTimeout(() => this.show = false, this.duration);
            }
        },
        dismiss() {
            this.show = false;
            clearTimeout(this.timer);
        }
    }"
    x-show="show"
    x-cloak
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 -translate-y-4"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 -translate-y-4"
    class="fixed top-4 right-4 z-[9999] max-w-sm w-full"
    style="display: none;">

    <div :class="{
            'border-emerald-400/30 bg-emerald-500/15 text-emerald-200': type === 'success',
            'border-red-400/30 bg-red-500/15 text-red-200': type === 'error',
            'border-blue-400/30 bg-blue-500/15 text-blue-200': type === 'info',
            'border-yellow-400/30 bg-yellow-500/15 text-yellow-200': type === 'warning',
        }"
        class="glass rounded-2xl border p-4 shadow-2xl shadow-black/40 backdrop-blur-md flex items-start gap-3">

        <div class="shrink-0">
            <template x-if="type === 'success'">
                {!! icon('correct', 'h-6 w-6') !!}
            </template>
            <template x-if="type !== 'success'">
                {!! icon('important', 'h-6 w-6') !!}
            </template>
        </div>

        <p class="flex-1 text-sm font-medium leading-relaxed" x-text="message"></p>

        <button @click="dismiss()"
            class="shrink-0 text-white/40 hover:text-white/80 transition-colors"
            aria-label="Tutup notifikasi">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
</div>