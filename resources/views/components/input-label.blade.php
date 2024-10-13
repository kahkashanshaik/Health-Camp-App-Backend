@props(['value', 'required'])
<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}
    @if (isset($required) && $required == true)
        <span class="text-red-800 font-bold">*</span>
    @endif
</label>
