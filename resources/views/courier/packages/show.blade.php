<x-app-layout>
    <x-session-alert/>

    <div class="bg-white p-4 rounded-lg" style="max-width: 1100px; margin: 50px auto 0;">

        <h1 class="text-center text-gray-900 text-3xl font-bold mb-5">{{__('titles.package_overview')}}</h1>
        <div class="row">
            <form action="{{ route('courier.packages.show') }}" method="get">
                <div class="mb-4 flex">
                    <x-filter-status-administrator :statuses="$statuses" :selectedStatus="$selectedStatus"/>
                    <button type="submit" class="border-gray-400 bg-black text-white font-bold py-2 px-4 rounded-lg">
                        Filter
                    </button>
                </div>
            </form>

            <x-search-bar :route="route('courier.packages.show')" :placeholder="__('titles.search_package')"/>

            @if(count($packages) == 0)
                <p class="text-center mb-5 mt-5"><i>{{__('messages.empty_packages')}}</i></p>
            @else
                <x-courier-packages-overview :packages="$packages"/>
            @endif
            {{ $packages->links() }}
        </div>
    </div>
</x-app-layout>
