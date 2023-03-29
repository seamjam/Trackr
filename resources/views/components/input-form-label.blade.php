@props(['label', 'placeholder' => null , 'id'])

<div class="mb-4" style="flex:1;">
    <label for="{{ $id }}" class="block text-gray-700 font-bold mb-2">{{ ucfirst($label) }}</label>
    <input type="text" name="{{ $id }}" id="{{ $id }}" class="border-gray-300 rounded-lg px-4 py-2 w-full" placeholder="{{ $placeholder ?? ucfirst($label) }}">
</div>
