<x-app-layout>
    <x-session-alert/>

    <div class="bg-white p-4 rounded-lg" style="width: 1400px; margin: 50px auto 0;">
        <h1 class="text-center text-gray-900 text-3xl font-bold mb-5">Orders</h1>


        <form action="{{ route('customer.show') }}" method="get">
            <div class="flex mb-4">
                <div class="mr-4">
                    <select name="status" id="status">
                        <option value="">All statuses</option>
                        @foreach ($statuses as $status)
                            <option
                                value="{{ $status->id }}" {{ $selectedStatus == $status->id ? 'selected' : '' }}>
                                {{ $status->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="border-gray-400 bg-black text-white font-bold py-2 px-4 rounded-lg">
                    Filter
                </button>
            </div>
        </form>

        <form method="GET" action="{{ route('customer.show') }}">
            <div class="">
                <input type="text" name="search" class="border-gray-400 border-2 rounded-lg w-full mb-5"
                       placeholder="Search webshop">
            </div>
        </form>


        @if ($packages->count() > 0)
            <x-table-orders-overview :packages="$packages"/>
        @else
            <p class="text-center mb-5 mt-5"><i>There are no registered orders</i></p>
        @endif

        {{ $packages->links() }}

    </div>
</x-app-layout>
