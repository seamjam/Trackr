<x-app-layout>

<form action="{{ route('language.switch') }}" method="POST">
    @csrf
    <select name="locale" onchange="this.form.submit()">
        <option value="en" {{ app()->getLocale() === 'en' ? 'selected' : '' }}>English</option>
        <option value="nl" {{ app()->getLocale() === 'nl' ? 'selected' : '' }}>Dutch</option>
    </select>
</form>
</x-app-layout>
