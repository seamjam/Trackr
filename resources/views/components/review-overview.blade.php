<div class="ml-10 ">
    <table class="w-full mx-auto">
        <thead>
        <tr>
            <th class="text-sm font-medium text-gray-600 p-2  bg-gray-100 text-center">
                {{__('titles.rating')}}</a>
            </th>
            <th class="text-sm font-medium text-gray-600 p-2  bg-gray-100 text-center">
                {{__('titles.review')}}</a>
            </th>
            <th class="text-sm font-medium text-gray-600 p-2  bg-gray-100 text-center">
                {{__('titles.name')}}</a>
            </th>
        </tr>
        </thead>
        <tbody class="h-40 overflow-y-scroll">
        @foreach ($objects as $object)
            <tr>
                <td class="p-2 border-t text-center">
                    {{ $object->review ? $object->review->stars : '' }}</td>
                <td class="p-2 border-t text-center">
                    {{ $object->review ? $object->review->description : '' }}</td>
                <td class="p-2 border-t text-center">
                    {{ $object->receiver_firstname }} {{ $object->receiver_lastname }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
