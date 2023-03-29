@props(['$packages'])

<x-app-layout>
    <x-session-alert/>

    <div class="bg-white p-4 rounded-lg" style="width: 1400px; margin: 50px auto 0;">

        <h1 class="text-center text-gray-900 text-3xl font-bold mb-5">labels overview</h1>
        <div class="row">
            <div class="mb-5 float-right">

                <button id="create-pdf-button">Create PDF</button>
                <a href="{{ route('administrator.labels.PDF') }}"
                    class="border-gray-400 bg-black border-2  text-white rounded-lg font-bold py-3 px-4 rounded-lg mr-3 mb-5">
                    Create PDF
                </a>

                <a href="{{ route('administrator.labels.create') }}"
                   class="border-gray-400 bg-black border-2  text-white rounded-lg font-bold py-3 px-4 rounded-lg mb-5">
                    Add new label
                </a>

            </div>

            <form action="{{ route('administrator.labels.show') }}" method="get">
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

            <form method="GET" action="{{ route('administrator.labels.show') }}">
                <div class="">
                    <input type="text" name="search" class="border-gray-400 border-2 rounded-lg w-full mb-5"
                           placeholder="Search label">
                </div>
            </form>
        </div>

        @if ($packages->count() > 0)
            <x-table-label-overview :objects="$packages"/>

            <div class="mt-5">
                {{ $packages->links() }}
            </div>

        @else
            <p class="text-center mb-5 mt-5"><i>There are no registered labels</i></p>
        @endif

    </div>
</x-app-layout>

<script>
    // voeg een event listener toe aan de "Create PDF" knop
    document.getElementById('create-pdf-button').addEventListener('click', function() {
        // haal alle geselecteerde checkboxes op
        const selectedPackages = document.querySelectorAll('input[name="selectedObjects[]"]:checked');
        // map de geselecteerde checkbox-waarden naar een array met ids
        const selectedPackageIds = Array.from(selectedPackages).map(el => el.value);
        // zet de geselecteerde package ids in een verborgen input veld genaamd 'selectedPackages'
        document.getElementById('selectedPackages').value = selectedPackageIds.join(',');
        // verstuur het formulier om de PDF te genereren
        document.getElementById('pdf-form').submit();
    });
</script>
