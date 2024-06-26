<x-app-layout>
    <x-session-alert/>

    <div class="bg-white p-4 rounded-lg mx-auto my-10 max-w-6xl">
        <h1 class="text-center text-gray-900 text-3xl font-bold mb-5">{{__('titles.Orders')}}</h1>

        <form action="{{ route('customer.show') }}" method="get">
            <div class="flex mb-4">
                <x-filter-status :statuses="$statuses" :selectedStatus="$selectedStatus"/>
                <div class="ml-4">
                    <button type="submit" class="bg-black text-white font-bold py-2 px-4 rounded-lg">
                        Filter
                    </button>
                </div>
            </div>
        </form>


        <x-search-bar :route="route('customer.show')" :placeholder="'webshops'"/>

        @if ($packages->count() > 0)
            <x-table-orders-overview :packages="$packages"/>
        @else
            <p class="text-center mb-5 mt-5"><i>{{__('messages.empty_orders')}}</i></p>
        @endif

        <x-pagination-link :objects="$packages"/>

    </div>
</x-app-layout>
