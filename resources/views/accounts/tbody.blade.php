@forelse ($users as $key => $user)
    <tr>
        <td class="align-middle text-center">{{ ++$key }}.</td>
        <td class="align-middle">{{ $user->name }}</td>
        <td class="align-middle">{{ $user->userType->type_name ?? '' }}</td>
        <td class="align-middle">{{ $user->email }}</td>
        <td class="align-middle">{!! $user->status !!}</td>
        <td class="align-middle text-nowrap">
            @if ($user->can_delete)
                <button class="btn-delete btn btn-danger btn-sm" title="Delete User" data-id="{{ $user->id }}">
                    <i class="fa fa-user-slash"></i>
                </button>
            @endif

            @if (! $user->is_verified)
                <button class="btn-resend btn btn-primary btn-sm" data-id="{{ $user->id }}" title="Resend Link">
                    <i class="fa fa-sync"></i>
                </button>
            @endif
        </td>
    </tr>
@empty
    <tr>
        <td colspan="3">No records found</td>
    </tr>
@endforelse