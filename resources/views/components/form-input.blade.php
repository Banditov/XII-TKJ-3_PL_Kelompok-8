@props([
    'label',
    'name',
    'type' => 'text',
    'placeholder' => '',
    'icon' => null,
    'live' => false,
])

<div class="text-left w-full">
    <label for="{{ $name }}" class="block text-sm font-medium text-white/70 mb-2 tracking-wide">
        {{ $label }} <span class="text-red-400">*</span>
    </label>
    
    <div class="relative">
        @if ($icon)
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                {!! icon($icon, 'h-5 w-5 text-white/30') !!}
            </div>
        @endif
        
        <input 
            type="{{ $type }}" 
            id="{{ $name }}" 
            wire:model{{ $live ? '.live' : '' }}="{{ $name }}"
            {{ $attributes->merge([
                'class' => 'w-full ' . ($icon ? 'pl-12' : 'px-4') . ' pr-4 py-4 bg-white/5 backdrop-blur-sm border border-white/15 rounded-xl text-white placeholder-white/30 focus:outline-none focus:ring-2 focus:ring-blue-400/30 focus:border-blue-400/30 transition-all duration-300 hover:bg-white/10',
                'placeholder' => $placeholder
            ]) }}
        >
    </div>
    
    @error($name)
        <span class="text-red-400 text-sm mt-1.5 flex items-center gap-1">
            {!! icon('important', 'w-4 h-4') !!}
            {{ $message }}
        </span>
    @enderror
</div>