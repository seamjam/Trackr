@props(['objects', 'sort', 'order'])

@php
    $newOrder = $order === 'asc' ? 'desc' : 'asc';
@endphp

<div class="ml-10 ">
    <table class="w-full m-2">
        <thead>
        <tr>
            <th class="w-1/8 text-left">
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'tracking_number', 'order' => $newOrder]) }}">Tracking
                    number</a>
            </th>
            <th class="w-1/8 text-left">
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'status_id', 'order' => $newOrder]) }}">Status</a>
            </th>
            <th class="w-1/8 text-left">
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'post_company_name', 'order' => $newOrder]) }}">Delivery
                    company</a>
            </th>
            <th class="w-1/8 text-left">
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'receiver_firstname', 'order' => $newOrder]) }}">Firstname</a>
            </th>
            <th class="w-1/8 text-left">
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'receiver_lastname', 'order' => $newOrder]) }}">Lastname</a>
            </th>
            <th class="w-1/8 text-left">
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'receiver_postal_code', 'order' => $newOrder]) }}">Postal
                    code</a>
            </th>
            <th class="w-1/8 text-left">
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'receiver_house_number', 'order' => $newOrder]) }}">House
                    number</a>
            </th>
            <th class="w-1/8 text-left">
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'pickupRequest_id', 'order' => $newOrder]) }}">
                    Pickup date</a>
            </th>
        </tr>
        </thead>
        <tbody class="h-40 overflow-y-scroll">
        @foreach ($objects as $object)
            <tr>
                <td class="py-1 border-b">{{ $object->tracking_number }}</td>
                <td class="py-1 border-b">{{ $object->status->name }}</td>
                @if($object->post_company->name != null)
                    <td class="py-1 border-b">{{ $object->post_company->name }}</td>
                @else
                    <td class="py-1 border-b">N/A</td>
                @endif
                <td class="py-1 border-b">{{ $object->receiver_firstname }}</td>
                <td class="py-1 border-b">{{ $object->receiver_lastname }}</td>
                <td class="py-1 border-b">{{ $object->receiver_postal_code }}</td>
                <td class="py-1 border-b">{{ $object->receiver_house_number }}</td>
                @if($object->pickup_date!= null)
                    <td class="py-1 border-b">{{ $object->pickupRequest->date }}</td>
                @else
                    <td class="py-1 border-b">N/A</td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
