@props(['packages'])
<div class="ml-10 ">
    <table class="w-full m-2">
        <thead>
        <tr>
            <th class="w-1/6 text-left">Id</th>
            <th class="w-1/6 text-left">Tracking number</th>
            <th class="w-1/6 text-left">Status</th>
            <th class="w-1/6 text-left">Webshop</th>
        </tr>
        </thead>
        <tbody class="h-40 overflow-y-scroll">
        @foreach($packages as $package)
            <tr>
                <td class="py-1 border-b">{{ $package->id }}</td>
                <td class="py-1 border-b">{{ $package->tracking_number }}</td>
                <td class="py-1 border-b">{{ $package->status->name }}</td>
                <td class="py-1 border-b">{{ $package->webshop->name }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
