<x-app-layout>
    <x-session-alert/>

    <link rel="stylesheet" href="{{ asset('css/status.css') }}">

    <div class="bg-white p-4 rounded-lg mx-auto my-10 max-w-6xl mb-5">

        <div class="bg-white p-4 rounded-lg mx-auto mt-12 lg:max-w-7xl">

            <h1 class="text-center text-gray-900 text-3xl font-bold mb-5">{{__('titles.order_details')}}</h1>
            <h2 class="text-center text-gray-900 text-3xl  mb-5">{{$package->post_company->name}}</h2>
            <h2 class="text-center text-gray-900 text-3x mb-5">{{__('titles.tracking_number')}}:: <i>{{$package->tracking_number}}</i></h2>

            <h1 class="text-center text-gray-900 text-3xl font-bold mb-5">{{$package->status->name}}</h1>

            <div class="wrapper mx-auto px-4">
                <div class="margin-area">
                    @for ($i = 1; $i <= 6; $i++)
                        <div class="dot dot-{{$i}}"
                             @if($package->status_id >= $i)style="background: #1f2937;" @endif>{{$i}}</div>
                        @if($i != 6)
                            <div class="progress-bar progress-bar-{{$i}}"
                                 @if($package->status_id >= $i + 1)style="background: #1f2937;" @endif></div>
                        @endif
                    @endfor
                </div>
            </div>

            <x-order-details-customer :package="$package"/>
            <x-review-section :package="$package"/>
        </div>
    </div>
</x-app-layout>


