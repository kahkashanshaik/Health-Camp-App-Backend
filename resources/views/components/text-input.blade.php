@props(['disabled' => false, 'additionalClasses'])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => isset($additionalClasses) ? $additionalClasses : 'form-input',
]) !!}>
