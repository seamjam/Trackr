<div class="ml-10 ">
    <table class="w-full m-2">
        <thead>
        <tr>
            <th class="w-1/6 text-left">Tracking number</th>
            <th class="w-1/6 text-left">status</th>
            <th class="w-1/6 text-left">Delivery company</th>
            <th class="w-1/6 text-left">Review</th>
            <th class="w-1/6 text-left pl-9">Select</th>
        </tr>
        </thead>
        <tbody class="h-40 overflow-y-scroll">
        @foreach ($objects as $object)
            <tr>
                <td class="py-1 border-b">{{ $object->tracking_number }}</td>
                <td class="py-1 border-b">{{ $object->status->name }}</td>
                <td class="py-1 border-b">{{ $object->post_company->name }}</td>
                @if($object->review != null)
                    <td class="py-1 border-b">{{ $object->review->description }}</td>
                @else
                    <td class="py-1 border-b"><i>There is no review left.</i></td>
                @endif

                <td class="py-1 border-b pl-12">
                       <input type="checkbox" name="selectedObjects[]" value="{{ $object->id }}">
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
