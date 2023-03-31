<x-app-layout>
    <x-session-alert/>

    <div class="bg-white p-4 rounded-lg" style="width: 1400px; margin: 50px auto 0;">

        <h1 class="text-center text-gray-900 text-3xl font-bold mb-5">Users overview</h1>

        <div class="row">

            <form method="GET" action="{{ route('user.show.blade.php') }}">
                <div class="">
                    <input type="text" name="search" class="border-gray-400 border-2 rounded-lg w-full mb-5"
                           placeholder="Search user">
                </div>
            </form>
        </div>

        @if ($users->count() > 0)

            <x-table-overview :objects="$users" :edit="false"/>

            <div class="mt-5">
                {{ $users->links() }}
            </div>

        @else
            <p class="text-center mb-5 mt-5"><i>There are no registered Trackr users</i></p>
        @endif

    </div>
</x-app-layout>
