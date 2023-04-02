<x-app-layout>
    <div class="bg-white p-4 rounded-lg" style="max-width: 950px; margin: 50px auto 0;">
        <h1 class="text-center text-gray-900 text-3xl font-bold mb-5">{{__('titles.add_delivery_user')}}
        </h1>

        <form method="POST" action="{{ route('superadmin.delivery.store') }}">
            @csrf

            <x-form-input name="name"/>
            <x-form-input name="email" type="email"/>
            <x-form-input name="phonenumber" type="tel"/>

            <div class="mb-4">
                <label for="Delivery company's name"
                       class="block text-gray-700 font-bold mb-2">{{__('titles.delivery-company_name')}}</label>
                <input type="text" name="delivercompany_name" id="delivercompany_name"
                       class="w-full border-gray-300 rounded-lg px-4 py-2 {{ $errors->has('delivercompany_name') ? 'border-red-500' : '' }}">
                <x-error-message :error="'delivercompany_name'"/>
            </div>


            <div style="height: 100px; overflow-y: scroll;">
            </div>
            <div class="mt-5">
                <button type="submit" class="bg-black text-white font-bold py-2 px-4 rounded-lg mr-2">
                    {{__('titles.add_user')}}
                </button>

                <button type="button" onclick="window.location.href='{{ route('superadmin.user.show') }}'"
                        class="bg-white border border-black text-black font-bold py-2 px-5 rounded-lg">
                    {{__('titles.return')}}
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
