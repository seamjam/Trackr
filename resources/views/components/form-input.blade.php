@props(['name', 'type' => 'text'])

<div class="mb-4">
    <label for="{{ $name }}" class="block text-gray-700 font-bold mb-2">{{ ucfirst($name) }}</label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" class="w-full border-gray-300 rounded-lg px-4 py-2 {{ $errors->has($name) ? 'border-red-500' : '' }}" {{ $attributes }}>
    <x-error-message :error="$name"/>
</div>
