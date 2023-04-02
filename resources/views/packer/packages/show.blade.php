<x-app-layout>
    <x-session-alert/>

    <div class="bg-white p-4 rounded-lg" style="width: 1500px; margin: 50px auto 0;">

        <h1 class="text-center text-gray-900 text-3xl font-bold mb-5">Packages overview</h1>

        <form action="{{ route('packer.packages.read') }}" method="get">
            <div class="flex mb-4">
                <x-filter-status-administrator :statuses="$statuses" :selectedStatus="$selectedStatus"/>

                <select name="is_sent"
                        class="border-gray-400 border-2 text-black font-bold py-2 px-4 rounded-lg mr-2">
                    <option value="" {{ $isSent === '' ? 'selected' : '' }}>All packages</option>
                    <option value="1" {{ $isSent === '1' ? 'selected' : '' }}>Sent packages</option>
                    <option value="0" {{ $isSent === '0' ? 'selected' : '' }}>Not sent packages</option>
                </select>

                <button type="submit" class="border-gray-400 bg-black text-white font-bold py-2 px-4 rounded-lg">
                    Filter
                </button>
            </div>
        </form>

        <x-search-bar :route="route('packer.packages.read')" :placeholder="'search label'"/>

        @if ($packages->count() > 0)

            <x-label-read-overview :objects="$packages" :sort="$sort" :order="$order"/>

            <x-pagination-link :objects="$packages"/>

        @else
            <p class="text-center mb-5 mt-5"><i>There are no registered packages</i></p>
        @endif
    </div>

    </div>
</x-app-layout>
