@props([
    'classes' => [],
    'selected' => null,
    'isTeacher' => false,
])

@if ($isTeacher && count($classes) > 1)
    <select 
        wire:model.live="{{ $selected }}" 
        {{ $attributes->merge([
            'class' => 'rounded-[14px] bg-white/5 border border-white/20 px-4 py-2.5 text-lg font-semibold text-white focus:outline-none focus:ring-2 focus:ring-blue-400/30 appearance-none cursor-pointer'
        ]) }}
    >
        @foreach ($classes as $class)
            <option value="{{ data_get($class, 'id') }}" class="bg-slate-900 text-white">
                {{ data_get($class, 'name') }}
            </option>
        @endforeach
    </select>
@elseif (count($classes) > 0)
    <p class="font-semibold">{{ data_get($classes[0], 'name') }}</p>
@else
    <p class="font-semibold">-</p>
@endif