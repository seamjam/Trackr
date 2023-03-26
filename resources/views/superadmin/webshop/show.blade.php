@props(['users'])
<x-app-layout>
    <x-session-alert/>

    <div class="bg-white p-4 rounded-lg" style="width: 1400px; margin: 50px auto 0;">

        <h1 class="text-center text-gray-900 text-3xl font-bold mb-5">Webshops overview</h1>

        <div class="row">
            <div class="mb-5 float-right">
                <a href="{{ route('webshop.create') }}"
                   class="border-gray-400 bg-black border-2  text-white rounded-lg font-bold py-3 px-4 rounded-lg mr-10 mb-5">
                    Add new Webshop
                </a>
            </div>
            <form method="GET" action="{{ route('webshop.show') }}">
                <div class="">
                    <input type="text" name="search" class="border-gray-400 border-2 rounded-lg w-full mb-5"
                           placeholder="Search webshops">
                </div>
            </form>
        </div>

        @if ($users->count() > 0)

            <x-table-webshops-overview :objects="$users"/>

            <div class="mt-5">
                {{ $users->links() }}
            </div>

        @else
            <p class="text-center mb-5 mt-5"><i>There are no registered Trackr webshops</i></p>
        @endif

    </div>
</x-app-layout>