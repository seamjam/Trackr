<table class="w-3/4 mx-auto">
    <thead>
    <tr>
        <th class="text-sm font-medium text-gray-600 p-2  bg-gray-100 text-center">
            <a href="{{ route('customer.show', ['column' => 'id', 'order' => 'desc']) }}">Id</a>
        </th>
        <th class="text-sm font-medium text-gray-600 p-2 bg-gray-100 text-center">
            <a href="{{ route('customer.show', ['column' => 'webshop_id', 'order' => 'desc']) }}">Webshop</a>
        </th>
    </tr>
    </thead>

    <tbody>
    @foreach($packages as $package)
        <tr>
            <td class="p-2 border-t text-center"><a
                    href="{{ route('customer.details', ['package' => $package->id]) }}">{{ $package->id }}</a></td>
            <td class="p-2 border-t text-center"><a
                    href="{{ route('customer.details', ['package' => $package->id]) }}">{{ $package->webshop->name }}</a>
            </td>

        </tr>
    @endforeach

    </tbody>
</table>
