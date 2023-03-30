@props(['$packages'])

<x-app-layout>
    <x-session-alert/>

    <div class="bg-white p-4 rounded-lg" style="width: 1400px; margin: 50px auto 0;">

        <h1 class="text-center text-gray-900 text-3xl font-bold mb-5">labels overview</h1>
        <div class="row">
            <div class="mb-3 float-right">
                <div class="flex">

                    <form id="csv-import-form" method="POST" action="{{ route('administrator.labels.importCSV') }}"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="csv_file" id="csv_file" class="hidden" accept=".csv">
                        <button type="button" id="upload-csv-button"
                                class="border-gray-400 bg-black border-2 text-white rounded-lg font-bold py-3 px-4 rounded-lg mr-3 mb-5">
                            Upload CSV
                        </button>
                    </form>

                    <form id="pdf-form" method="POST" action="{{ route('administrator.labels.PDF') }}">
                        @csrf
                        <input type="hidden" name="selectedPackages" id="selectedPackages">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" id="create-pdf-button"
                                class="border-gray-400 bg-black border-2 text-white rounded-lg font-bold py-3 px-4 rounded-lg mr-3 mb-5">
                            Create PDF
                        </button>
                    </form>

                    <a href="{{ route('administrator.labels.create') }}"
                       class="border-gray-400 bg-black border-2  text-white rounded-lg font-bold py-3 px-4 rounded-lg mb-5">
                        Add new label
                    </a>
                </div>
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
                    <input type="text" name="search" class="border-gray-400 border-2 rounded-lg w-full mb-3"
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
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('create-pdf-button').addEventListener('click', function (event) {
            const selectedPackages = document.querySelectorAll('input[name="selectedObjects[]"]:checked');
            const selectedPackageIds = Array.from(selectedPackages).map(el => el.value);
            document.getElementById('selectedPackages').value = selectedPackageIds.join(',');
            document.getElementById('pdf-form').submit();
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('upload-csv-button').addEventListener('click', function () {
            document.getElementById('csv_file').click();
        });

        document.getElementById('csv_file').addEventListener('change', function () {
            document.getElementById('csv-import-form').submit();
        });
    });

</script>


