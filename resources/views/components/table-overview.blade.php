@props(['objects'])

<div class="ml-10 ">
<table class="w-full ml-2">
    <thead>
    <tr>
        <th class="w-1/6 text-left">Name</th>
        <th class="w-1/6 text-left">Email</th>
        <th class="w-1/6 text-left">Phone Number</th>
        <th class="w-1/6 text-left">Roles</th>
        <th class="w-1/6 text-left"></th>
    </tr>
    </thead>
    <tbody class="h-40 overflow-y-scroll">
    @foreach ($objects as $object)
            <td class="py-1 border-b">{{ $object->name }}</td>
            <td class="py-1 border-b">{{ $object->email }}</td>
            <td class="py-1 border-b">{{ $object->phonenumber }}</td>
            <td class="py-1 border-b">{{ implode(', ', $object->roles->pluck('name')->toArray()) }}</td>
            <td class="py-1 border-b">
                <a href="{{ route('user.edit', $object->id) }}">Edit</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
