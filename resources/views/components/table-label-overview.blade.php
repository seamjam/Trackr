@props(['objects', 'sort', 'order'])

@php
    $newOrder = $order === 'asc' ? 'desc' : 'asc';
@endphp

<div class="ml-10 ">
    <table class="w-full m-2">
        <thead>
        <tr>
            <th class="w-1/6 text-left">
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'tracking_number', 'order' => $newOrder]) }}"> {{__('titles.tracking_number')}}</a>
            </th>
            <th class="w-1/6 text-left">
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'status_id', 'order' => $newOrder]) }}"> {{__('titles.status')}}</a>
            </th>
            <th class="w-1/6 text-left">
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'post_company_name', 'order' => $newOrder]) }}"> {{__('titles.delivery_company')}}</a>
            </th>
            <th class="w-1/6 text-left pl-9"> {{__('titles.select')}}</th>
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
                <td class="py-1 border-b pl-12">
                    <input type="checkbox" name="selectedObjects[]" value="{{ $object->id }}">
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
