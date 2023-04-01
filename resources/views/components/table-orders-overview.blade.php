<table class="w-full text-left table-collapse">
    <thead>
    <tr>
        <th class="text-sm font-medium text-gray-600 p-2 pl-5 bg-gray-100">Tracking nummer</th>
        <th class="text-sm font-medium text-gray-600 p-2 bg-gray-100">Postmaatschappij</th>
        <th class="text-sm font-medium text-gray-600 p-2 bg-gray-100">Status</th>
        <th class="text-sm font-medium text-gray-600 p-2 bg-gray-100">Webshop</th>
    </tr>
    </thead>
    <tbody>
    @foreach($packages as $package)
        <tr>
            <td class="p-2 border-t"><a href="{{ route('customer.details', ['package' => $package->id]) }}">{{ $package->tracking_number }}</a></td>
            <td class="p-2 border-t"><a href="{{ route('customer.details', ['package' => $package->id]) }}">{{ $package->post_company->name }}</td>
            <td class="p-2 border-t"><a href="{{ route('customer.details', ['package' => $package->id]) }}">{{ $package->status->name }}</td>
            <td class="p-2 border-t"><a href="{{ route('customer.details', ['package' => $package->id]) }}">{{ $package->webshop->name }}</td>
        </tr>
    @endforeach

    </tbody>
</table>
