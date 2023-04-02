<div class="mr-4">
    <select name="status" id="status" class="border-gray-400 border-2 text-black font-bold py-2 px-4 rounded-lg">
        >
        <option value="">{{__('titles.Filter_status')}}</option>
        @foreach ($statuses as $status)
            <option
                value="{{ $status->id }}" {{ $selectedStatus == $status->id ? 'selected' : '' }}>
                {{ $status->name }}
            </option>
        @endforeach
    </select>
</div>
