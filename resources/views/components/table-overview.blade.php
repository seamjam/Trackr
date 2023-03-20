@props(['objects'])

<table class="w-full table-fixed">
    <thead>
    <tr>
        <th class="w-1/5 text-center">Select</th>
        <th class="w-1/5 text-left">Name</th>
        <th class="w-1/5 text-left">Email</th>
        <th class="w-1/5 text-left">PhoneNumber</th>
        <th class="w-1/5 text-left">Role</th>
    </tr>
    </thead>
    <tbody style="height: 10px; overflow-y: scroll;">
    @foreach ($objects as $object)
        <tr>
            <td class="py-2 text-center">
                <input type="checkbox" name="users[]" value="{{ $object->id }}">
            </td>
            <td class="py-2 border-b">{{ $object->name }}</td>
            <td class="py-2 border-b">{{ $object->email }}</td>
            <td class="py-2 border-b">{{ $object->phonenumber }}</td>
            <td class="py-2 border-b">{{ implode(', ', $object->roles->pluck('name')->toArray()) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
