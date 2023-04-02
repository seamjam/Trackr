<x-app-layout>
    <x-session-alert/>

    <div class="bg-white p-4 rounded-lg" style="width: 1400px; margin: 50px auto 0;">

        <h1 class="text-center text-gray-900 text-3xl font-bold mb-5">{{__('titles.trackr_users_overview')}}</h1>

        <div class="row">
            <div class="mb-5 float-right">
                <a href="{{ route('superadmin.delivery.create') }}"
                   class="border-gray-400 bg-black border-2  text-white rounded-lg font-bold py-3 px-4 rounded-lg mr-10 mb-5">
                    {{__('titles.add_delivery_user')}}
                </a>
            </div>

            <x-search-bar :route="route('superadmin.user.show')" :placeholder="__('titles.search_user')"/>

        </div>


        @if ($users->count() > 0)

            <x-table-overview-admin :objects="$users" :direction="$direction"/>

            <x-pagination-link :objects="$users"/>

        @else
            <p class="text-center mb-5 mt-5"><i>{{__('messages.empty_users')}}</i></p>
        @endif

    </div>
</x-app-layout>
