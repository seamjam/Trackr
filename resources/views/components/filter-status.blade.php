<div class="mb-4 w-full md:w-auto">
    <select name="status" id="status"
            class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
        <option value="">All statuses</option>
        @foreach ($statuses as $status)
            <option
                value="{{ $status->id }}" {{ $selectedStatus == $status->id ? 'selected' : '' }}>
                {{ $status->name }}
            </option>
        @endforeach
    </select>
</div>
