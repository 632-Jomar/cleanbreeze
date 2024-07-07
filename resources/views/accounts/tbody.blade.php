@forelse ($users as $key => $user)
    <tr>
        <td class="align-middle text-center">{{ ++$key }}.</td>
        <td class="align-middle">{{ $user->name }}</td>
        <td class="align-middle">{{ $user->userType->type_name ?? '' }}</td>
        <td class="align-middle">{{ $user->email }}</td>
        <td class="align-middle">{!! $user->status !!}</td>
        <td class="align-middle">
            @if (! $user->is_verified)
                <button class="btn-resend btn btn-primary">
                    <i class="fa fa-sync"></i>
                </button>
            @endif

            <button class="btn btn-danger" disabled>
                <i class="fa fa-trash"></i>
            </button>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="3">No records found</td>
    </tr>
@endforelse