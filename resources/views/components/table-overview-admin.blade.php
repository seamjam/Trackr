@props(['objects', 'direction'])

<div class="ml-10">
    <table class="w-full ml-2">
        <thead>
        <tr>
            <th class="w-1/6 text-left">
                <a href="{{ route('superadmin.user.show', array_merge(request()->query(), ['sort' => 'name', 'direction' => $direction === 'asc' ? 'desc' : 'asc'])) }}">{{__('titles.name')}}</a>
            </th>
            <th class="w-1/6 text-left">
                <a href="{{ route('superadmin.user.show', array_merge(request()->query(), ['sort' => 'email', 'direction' => $direction === 'asc' ? 'desc' : 'asc'])) }}">{{__('titles.email')}}</a>
            </th>
            <th class="w-1/6 text-left">
                <a href="{{ route('superadmin.user.show', array_merge(request()->query(), ['sort' => 'phonenumber', 'direction' => $direction === 'asc' ? 'desc' : 'asc'])) }}">{{__('titles.phonenumber')}}
                    </a>
            </th>
        </tr>
        </thead>

        <tbody class="h-40 overflow-y-scroll">
        @foreach ($objects as $object)
            <tr>
                <td class="py-1 border-b">{{ $object->name }}</td>
                <td class="py-1 border-b">{{ $object->email }}</td>
                <td class="py-1 border-b">{{ $object->phonenumber }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
