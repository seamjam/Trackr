<x-app-layout>

    <x-session-alert/>

    <div class="bg-white p-4 rounded-lg" style="max-width: 1800px; margin: 50px auto 0;">

        <h1 class="text-center text-gray-900 text-3xl font-bold mb-5">Users overview</h1>

        <a href="{{ route('users.create') }}"
           class="bg-black text-white font-bold py-2 px-4 rounded-lg float-right mr-10 mb-5">Add new Trackr user</a>

        @if ($users->count() > 0)
            <form method="POST" action="{{ route('users.delete') }}">
                @csrf

                <x-table-overview :objects="$users"/>

                <div class="text-center mt-5">
                    <button type="submit" class="bg-black text-white font-bold py-2 px-2 rounded-lg mt-5">Delete
                        selected users
                    </button>
                </div>
            </form>
        @else
            <p class="text-center mb-5 mt-5"><i>There are no registered Trackr users</i></p>
        @endif
    </div>
</x-app-layout>


