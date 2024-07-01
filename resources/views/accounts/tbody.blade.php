@forelse ($users as $key => $user)
    <tr>
        <td class="text-center">{{ ++$key }}.</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->userType->type_name ?? '' }}</td>
        <td>{{ $user->email }}</td>
    </tr>
@empty
    <tr>
        <td colspan="3">No records found</td>
    </tr>
@endforelse