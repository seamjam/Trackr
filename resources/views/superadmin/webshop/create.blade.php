<x-app-layout>
    <div class="bg-white p-4 rounded-lg" style="max-width: 950px; margin: 50px auto 0;">

        <form method="POST" action="{{ route('superadmin.webshop.store') }}">
            @csrf

            <h2 class="text-center text-gray-900 text-3xl font-bold mb-5">{{__('titles.add_webshop')}}</h2>

            <x-form-input name="webshop_name" label="Webshop name"/>

            <h2 class="text-center text-gray-900 text-3xl font-bold mb-5">{{__('titles.create_webshop_admin')}}</h2>

            <x-form-input name="name"/>
            <x-form-input name="email" type="email"/>
            <x-form-input name="phonenumber" type="tel"/>

            <div class="mt-5">
                <button type="submit" class="bg-black text-white font-bold py-2 px-4 rounded-lg mr-2">
                    {{__('titles.add_user_webshop')}}
                </button>

                <button type="button" onclick="window.location.href='{{ route('superadmin.webshop.show') }}'"
                        class="bg-white border border-black text-black font-bold py-2 px-5 rounded-lg">
                    {{__('titles.return')}}
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
