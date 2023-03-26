<x-app-layout>


    <div class="bg-white p-4 rounded-lg" style="max-width: 950px; margin: 50px auto 0;">
        <h1 class="text-center text-gray-900 text-3xl font-bold mb-5">Edit {{$user->name}}</h1>

        <form method="POST" action="{{ route('user.update', $user->id) }}">
            @csrf
            @method('PUT')
            <x-form-input name="name" :value="$user->name"/>
            <x-form-input name="email" type="email" :value="$user->email"/>
            <x-form-input name="phonenumber" type="tel" :value="$user->phonenumber"/>

            <label for="roles" class="block text-gray-700 font-bold mb-2">Rol(s)</label>
            <div style="height: 100px; overflow-y: scroll;">
                @foreach($roles as $role)
                    <div>
                        <input type="checkbox" name="roles[]" id="role_{{ $role->id }}"
                               value="{{ $role->id }}" {{ in_array($role->id, $selectedRoles) ? 'checked' : '' }}>
                        <label for="role_{{ $role->id }}">{{ $role->name }}</label>
                    </div>
                @endforeach
            </div>
            <x-error-message :error="'roles'"/>

            <div class="mt-5">
                <button type="submit" class="bg-black text-white font-bold py-2 px-4 rounded-lg">
                    Update User
                </button>

                <button type="button" onclick="window.location.href='{{ route('user.show') }}'"
                        class="bg-white border border-black text-black font-bold py-2 px-5 rounded-lg">
                    Cancel
                </button>

                <form method="POST" action="{{ route('user.destroy', $user->id) }}">
                    @csrf
                    @method('DELETE')
                        <button type="submit" class="bg-white border border-black text-black font-bold py-2 px-5 rounded-lg ml-5">
                            Delete
                        </button>
                </form>
            </div>
        </form>
    </div>

</x-app-layout>
