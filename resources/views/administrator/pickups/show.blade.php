<!-- administrator.pickups.show -->

<x-app-layout>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

    <div class="bg-white p-4 rounded-lg" style="max-width: 1100px; margin: 50px auto 0;">

        <div id="calendar"></div>
    </div>

    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                events : [
                        @foreach($packages as $package)
                        @if($package->pickupRequest)
                    {
                        title : '{{ $package->receiver_firstname }} {{ $package->receiver_lastname }}',
                        start : '{{ $package->pickupRequest->date }}T{{ $package->pickupRequest->time }}',
                        url : '{{ route('administrator.pickups.show', $package->id) }}'
                    },
                    @endif
                    @endforeach
                ]
            });
        });
    </script>
</x-app-layout>
