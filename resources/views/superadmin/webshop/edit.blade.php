<x-app-layout>

<div class="bg-white p-4 rounded-lg" style="max-width: 950px; margin: 50px auto 0;">

    <h1 class="text-center text-gray-900 text-3xl font-bold mb-5">Edit</h1>

    <form method="POST" action="{{ route('webshop.update', $user->id) }}">
        @csrf
        @method('PUT')

        <h2 class="text-center text-gray-900 text-3xl font-bold mb-5">Webshop</h2>

        <x-form-input name="webshop_name" label="Webshop name" :value="$user->webshop->name"/>
        <x-form-input name="postcode" label="Postcode" :value="$user->webshop->postcode"/>
        <x-form-input name="house_number" label="House number" :value="$user->webshop->house_number"/>


        <h2 class="text-center text-gray-900 text-3xl font-bold mb-5">Webshop Admin</h2>

        <x-form-input name="name" :value="$user->name"/>
        <x-form-input name="email" type="email" :value="$user->email"/>
        <x-form-input name="phonenumber" type="tel" :value="$user->phonenumber"/>

        <div class="mt-5">
            <button type="submit" class="bg-black text-white font-bold py-2 px-4 rounded-lg mr-2">
                Update User and Webshop
            </button>

            <button type="button" onclick="window.location.href='{{ route('webshop.show') }}'"
                    class="bg-white border border-black text-black font-bold py-2 px-5 rounded-lg">
                Return
            </button>
        </div>
    </form>
</div>
</x-app-layout>
