@props(['users', 'direction'])

<x-app-layout>
    <x-session-alert/>

    <div class="bg-white p-4 rounded-lg" style="width: 1400px; margin: 50px auto 0;">

        <h1 class="text-center text-gray-900 text-3xl font-bold mb-5">{{__('titles.employees')}}</h1>

        <div class="row">
            <div class="mb-5 float-right">
                <a href="{{ route('webshop.user.create') }}"
                   class="border-gray-400 bg-black border-2  text-white rounded-lg font-bold py-3 px-4 rounded-lg mr-10 mb-5">
                    {{__('titles.add_employee')}}
                </a>
            </div>

            <x-search-bar :route="route('webshop.user.show')" :placeholder="'search user'"/>

        </div>

        @if ($users->count() > 0)

            <x-table-overview :objects="$users" :edit="true" :direction="$direction"/>

            <x-pagination-link :objects="$users"/>

        @else
            <p class="text-center mb-5 mt-5"><i>{{__('messages.empty_users')}}:</i></p>
    @endif

</x-app-layout>
