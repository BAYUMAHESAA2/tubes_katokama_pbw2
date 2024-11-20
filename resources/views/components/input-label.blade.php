@props(['value'])

<label {{ $attributes->merge(['form-label' => 'block font-medium text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>
