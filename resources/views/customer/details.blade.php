<x-app-layout>
    <x-session-alert/>

    <div class="bg-white p-4 rounded-lg mx-auto mt-12 lg:max-w-7xl">

        <div class="bg-white p-4 rounded-lg mx-auto mt-12 lg:max-w-7xl">

            <h1 class="text-center text-gray-900 text-3xl font-bold mb-5">Order details</h1>
            <h1 class="text-center text-gray-900 text-3xl font-bold mb-5">{{$package->tracking_number}}</h1>
            <h1 class="text-center text-gray-900 text-3xl font-bold mb-5">{{$package->status->name}}</h1>


            <div class="wrapper mx-auto px-4">

                <div class="margin-area">

                    @for ($i = 1; $i <= 6; $i++)
                        <div class="dot dot-{{$i}} ml-2"
                             @if($package->status_id >= $i)style="background: #1f2937;" @endif>{{$i}}</div>
                        @if($i != 6)
                            <div class="progress-bar progress-bar-{{$i}}"
                                 @if($package->status_id >= $i + 1)style="background: #1f2937;" @endif></div>
                        @endif
                    @endfor
                </div>

            </div>


            <div class="my-5">
                <h2 class="text-xl font-medium text-gray-900">Order details</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                    <div>
                        <span class="font-medium text-gray-600">Webshop:</span>
                        <span>{{ $package->webshop->name }}</span>
                    </div>
                    <div>
                        <span class="font-medium text-gray-600">Naam:</span>
                        <span>{{ $package->receiver_firstname }}</span>
                    </div>
                    <div>
                        <span class="font-medium text-gray-600">Achternaam:</span>
                        <span>{{ $package->receiver_lastname }}</span>
                    </div>
                    <div>
                        <span class="font-medium text-gray-600">Postcode:</span>
                        <span>{{ $package->receiver_postal_code }}</span>
                    </div>
                    <div>
                        <span class="font-medium text-gray-600">Huisnummer:</span>
                        <span>{{ $package->receiver_house_number }}</span>
                    </div>
                </div>
            </div>



            <div class="my-5">
                <h2 class="text-xl font-medium text-gray-900 mb-3">Plaats een recensie</h2>
                <form action="{{ route('customer.review') }}" method="post">
                    @csrf
                    <input type="hidden" name="package_id" value="{{ $package->id }}">

                    <div class="mb-3">
                        <label for="rating" class="block text-gray-700 text-sm font-medium mb-2">Aantal sterren:</label>
                        <select name="rating" id="rating" class="form-select block w-full mt-1 text-sm rounded-md">
                            <option value="">Selecteer het aantal sterren</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="review" class="block text-gray-700 text-sm font-medium mb-2">Recensie:</label>
                        <textarea name="review" id="review" rows="4"
                                  class="form-textarea block w-full mt-1 text-sm rounded-md"></textarea>
                    </div>
                    <button type="submit" class="bg-black text-white font-bold py-2 px-4 rounded-lg mr-2 mt-4">Verstuur recensie</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
<style>
    .wrapper {
        width: 100%;
        max-width: 844px;
        height: 100px;
        margin: 0 auto;
    }

    .margin-area {
        position: relative;
        text-align: center;
        font-family: "Trebuchet", sans-serif;
        font-size: 14px;
        margin: 0 20px;
    }

    .dot {
        height: 30px;
        width: 30px;
        position: absolute;
        background: gray;
        border-radius: 50%;
        top: 10px;
        color: white;
        line-height: 30px;
        z-index: 9999;
    }

    .dot-1 {
        left: -4.5%;
    }

    .dot-2 {
        left: 20%;
    }

    .dot-3 {
        left: 40%;
    }

    .dot-4 {
        left: 60%;
    }

    .dot-5 {
        left: 80%;
    }

    .dot-6 {
        left: 100%;
    }

    .progress-bar {
        position: absolute;
        height: 10px;
        width: 30%;
        top: 20px;
        background: gray;
    }

    .progress-bar-1 {
        left: 0%;
    }

    .progress-bar-2 {
        left: 30%;
    }

    .progress-bar-3 {
        left: 40%;
    }

    .progress-bar-4 {
        left: 55%;
    }

    .progress-bar-5 {
        left: 75%;
    }



</style>

