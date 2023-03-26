<x-app-layout>
    <div class="bg-white p-4 rounded-lg" style="max-width: 950px; margin: 50px auto 0;">

        <form method="POST" action="{{ route('webshop.store') }}">
            @csrf

            <h2 class="text-center text-gray-900 text-3xl font-bold mb-5">create Webshop</h2>

            <x-form-input name="webshop_name" label="Webshop name"/>
            <x-form-input name="postcode" label="Postcode"/>
            <x-form-input name="house_number" label="House number"/>


            <h2 class="text-center text-gray-900 text-3xl font-bold mb-5">create webshop admin</h2>

            <x-form-input name="name"/>
            <x-form-input name="email" type="email"/>
            <x-form-input name="phonenumber" type="tel"/>

            <div class="mt-5">
                <button type="submit" class="bg-black text-white font-bold py-2 px-4 rounded-lg mr-2">
                    Add User and Webshop
                </button>

                <button type="button" onclick="window.location.href='{{ route('webshop.show') }}'"
                        class="bg-white border border-black text-black font-bold py-2 px-5 rounded-lg">
                    Return
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
