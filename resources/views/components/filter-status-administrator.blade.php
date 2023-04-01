
<div class="mr-4">
    <select name="status" id="status">
        <option value="">All statuses</option>
        @foreach ($statuses as $status)
            <option
                value="{{ $status->id }}" {{ $selectedStatus == $status->id ? 'selected' : '' }}>
                {{ $status->name }}
            </option>
        @endforeach
    </select>
</div>
