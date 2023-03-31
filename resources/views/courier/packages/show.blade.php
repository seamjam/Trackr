<x-app-layout>
    <x-session-alert/>

    <div class="bg-white p-4 rounded-lg" style="max-width: 1100px; margin: 50px auto 0;">

        <h1 class="text-center text-gray-900 text-3xl font-bold mb-5">Registered packages</h1>
        <div class="row">

            <form method="GET" action="{{ route('courier.packages.show') }}">
                <div class="">
                    <input type="text" name="search" class="border-gray-400 border-2 rounded-lg w-full mb-3"
                           placeholder="Search package">
                </div>
            </form>

            @if(count($packages) == 0)
                <p class="text-center mb-5 mt-5"><i>There are no registered packages</i></p>
            @else
                <x-courier-packages-overview :packages="$packages" />
            @endif
            {{ $packages->links() }}

        </div>
    </div>
</x-app-layout>
