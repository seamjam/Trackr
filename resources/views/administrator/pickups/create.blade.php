<x-app-layout>
    <x-session-alert/>

    <div class="bg-white p-4 rounded-lg" style="width: 500px; margin: 50px auto 0;">
        <h1 class="text-center text-gray-900 text-3xl font-bold mb-5">{{__('titles.plan_pickup')}}</h1>

        <form action="{{ route('administrator.pickups.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="pickup_date" class="block mb-2">{{__('titles.pick_up_date')}}:</label>
                <input type="date" id="pickup_date" name="pickup_date"
                       class="border-gray-400 border-2 rounded-lg w-full"
                       min="{{ \Carbon\Carbon::today()->format('Y-m-d') }}"
                       value="{{ old('pickup_date') }}">
                @error('pickup_date')
                <div class="text-red-500 italic text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="pickup_time" class="block mb-2">{{__('titles.pick_up_time')}}:</label>
                <input type="time" id="pickup_time" name="pickup_time"
                       class="border-gray-400 border-2 rounded-lg w-full"
                       value="{{ old('pickup_time') }}">
                @error('pickup_time')
                <div class="text-red-500 italic text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="postal_code" class="block mb-2">{{__('titles.postal_code')}}:</label>
                <input type="text" id="postal_code" name="postal_code"
                       class="border-gray-400 border-2 rounded-lg w-full"
                       value="{{ old('postal_code') }}">
                @error('postal_code')
                <div class="text-red-500 italic text-sm">{{ $message }}</div>
                @enderror


            </div>

            <div class="mb-4">
                <label for="house_number" class="block mb-2">{{__('titles.house_number')}}:</label>
                <input type="number" id="house_number" name="house_number"
                       class="border-gray-400 border-2 rounded-lg w-full"
                       value="{{ old('house_number') }}">
                @error('house_number')
                <div class="text-red-500 italic text-sm">{{ $message }}</div>
                @enderror
            </div>

            <input type="hidden" name="selectedPackages"
                   value="{{ implode(',', $selectedPackages->pluck('id')->toArray()) }}">

            <div class="text-center">
                <button type="submit" class="border-gray-400 bg-black text-white font-bold py-2 px-4 rounded-lg">
                    {{__('titles.schedule')}}
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
