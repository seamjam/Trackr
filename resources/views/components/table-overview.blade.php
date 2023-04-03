@props(['objects', 'edit', 'direction'])

<div class="ml-10">
    <table class="w-full ml-2">
        <thead>
        <tr>
            <th class="w-1/6 text-left">
                <a href="{{ route('webshop.user.show', array_merge(request()->query(), ['sort' => 'name', 'direction' => $direction === 'asc' ? 'desc' : 'asc'])) }}">{{__('titles.name')}}</a>
            </th>
            <th class="w-1/6 text-left">
                <a href="{{ route('webshop.user.show', array_merge(request()->query(), ['sort' => 'email', 'direction' => $direction === 'asc' ? 'desc' : 'asc'])) }}">{{__('titles.email')}}</a>
            </th>
            <th class="w-1/6 text-left">
                <a href="{{ route('webshop.user.show', array_merge(request()->query(), ['sort' => 'phonenumber', 'direction' => $direction === 'asc' ? 'desc' : 'asc'])) }}">{{__('titles.phonenumber')}}
                    </a>
            </th>
            <th class="w-1/6 text-left">{{__('titles.rol')}}:</th>

            @if($edit)
                <th class="w-1/6 text-left"></th>
            @endif
        </tr>
        </thead>

        <tbody class="h-40 overflow-y-scroll">
        @foreach ($objects as $object)
            <tr>
                <td class="py-1 border-b">{{ $object->name }}</td>
                <td class="py-1 border-b">{{ $object->email }}</td>
                <td class="py-1 border-b">{{ $object->phonenumber }}</td>
                <td class="py-1 border-b">{{ implode(', ', $object->roles->pluck('name')->toArray()) }}</td>
                @if($edit)
                    <td class="py-1 border-b">
                        <form action="{{ route('webshop.user.edit', $object->id) }}" method="GET">
                            <button type="submit"
                                    class="border-gray-400 bg-black text-white font-bold py-2 px-4 rounded-lg">
                                {{__('titles.edit')}}
                            </button>
                        </form>
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
