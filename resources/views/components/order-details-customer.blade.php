<div class="my-5">
    <h2 class="text-xl font-medium text-gray-900 mb-3">Order details</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
        <div>
            <span class="font-medium text-gray-600m">Webshop:</span>
            <span>{{ $package->webshop->name }}</span>
        </div>
        <div>
            <span class="font-medium text-gray-600">Naam:</span>
            <span>{{ $package->receiver_firstname }}</span>
        </div>
        <div>
            <span class="font-medium text-gray-600">Achternaam:</span>
            <span>{{ $package->receiver_lastname }}</span>
        </div>
        <div>
            <span class="font-medium text-gray-600">Postcode:</span>
            <span>{{ $package->receiver_postal_code }}</span>
        </div>
        <div>
            <span class="font-medium text-gray-600">Huisnummer:</span>
            <span>{{ $package->receiver_house_number }}</span>
        </div>
    </div>
</div>
