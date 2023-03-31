<x-app-layout>
    <div class="bg-white p-4 rounded-lg" style="width: 500px; margin: 50px auto 0;">
        <h1 class="text-center text-gray-900 text-3xl font-bold mb-5">Plan Pick up</h1>

        <form action="{{ route('administrator.pickups.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="pickup_date" class="block mb-2">Pick up Date:</label>
                <input type="date" id="pickup_date" name="pickup_date"
                       class="border-gray-400 border-2 rounded-lg w-full" required>
            </div>

            <div class="mb-4">
                <label for="pickup_time" class="block mb-2">Pick up Time:</label>
                <input type="time" id="pickup_time" name="pickup_time"
                       class="border-gray-400 border-2 rounded-lg w-full" required>
            </div>

            <input type="hidden" name="selectedPackages"
                   value="{{ implode(',', $selectedPackages->pluck('id')->toArray()) }}">

            <button type="submit" class="border-gray-400 bg-black text-white font-bold py-2 px-4 rounded-lg">
                Schedule Pick up
            </button>
        </form>
    </div>
</x-app-layout>
