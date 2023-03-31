<x-app-layout>
    <x-session-alert/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

    <div class="bg-white p-4 rounded-lg" style="max-width: 1100px; margin: 50px auto 0;">

        <div id="calendar"></div>
    </div>

    <script>
        $(document).ready(function () {
            $('#calendar').fullCalendar({
                events: [
                        @foreach($pickupRequests as $pickupRequest)
                    {
                        title: '-{{ $pickupRequest->postal_code }} {{ $pickupRequest->house_number }}',
                        start: '{{ \Carbon\Carbon::parse($pickupRequest->date . ' ' . $pickupRequest->time)->toIso8601String() }}'
                    },
                    @endforeach
                ],
                timeFormat: 'H:mm'
            });
        });
    </script>

</x-app-layout>
