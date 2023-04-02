<x-app-layout>

<div class="bg-white p-4 rounded-lg" style="max-width: 950px; margin: 50px auto 0;">

    <h1 class="text-center text-gray-900 text-3xl font-bold mb-5">{{__('titles.edit')}}</h1>

    <form method="POST" action="{{ route('superadmin.webshop.update', $user->id) }}">
        @csrf
        @method('PUT')

        <h2 class="text-center text-gray-900 text-3xl font-bold mb-5">{{__('titles.webshop')}}</h2>

        <x-form-input name="webshop_name" label="Webshop name" :value="$user->webshop->name"/>

        <h2 class="text-center text-gray-900 text-3xl font-bold mb-5">{{__('titles.create_webshop_admin')}}</h2>

        <x-form-input name="name" :value="$user->name"/>
        <x-form-input name="email" type="email" :value="$user->email"/>
        <x-form-input name="phonenumber" type="tel" :value="$user->phonenumber"/>

        <div class="mt-5">
            <button type="submit" class="bg-black text-white font-bold py-2 px-4 rounded-lg mr-2">
                {{__('titles.update_user_webshop')}}
            </button>

            <button type="button" onclick="window.location.href='{{ route('superadmin.webshop.show') }}'"
                    class="bg-white border border-black text-black font-bold py-2 px-5 rounded-lg">
                {{__('titles.return')}}
            </button>
        </div>
    </form>
</div>
</x-app-layout>
