<table class="table table-bordered">
    <thead>
        <tr class="bg-gradient-info">
            <td class="align-middle text-center py-1" rowspan="2">Sales Rep.</td>
            <td class="align-middle text-center py-1" colspan="3">Quotation</td>
        </tr>

        <tr class="bg-gradient-info">
            <td class="align-middle text-center py-1">Approved</td>
            <td class="align-middle text-center py-1">Revised</td>
            <td class="align-middle text-center py-1">Total</td>
        </tr>
    </thead>

    <tbody>
        @foreach ($users as $user)
            <tr>
                <td class="py-2 lh-1">{{ $user->name }}
                    @if ($user->deleted_at)
                        <i class="text-danger text-xs">(Deleted)</i>
                    @endif
                </td>
                <td class="text-center py-2">{{ number_format($user->approved_quotations_count) }}</td>
                <td class="text-center py-2">{{ number_format($user->revised_quotations_count) }}</td>
                <td class="text-center py-2">{{ number_format($user->quotations_count) }}</td>
            </tr>
        @endforeach
    </tbody>

    <tfoot class="bg-secondary">
        <tr>
            <td class="text-center"></td>
            <td class="text-center py-2">{{ $users->sum('approved_quotations_count') }}</td>
            <td class="text-center py-2">{{ $users->sum('revised_quotations_count') }}</td>
            <td class="text-center py-2">{{ $users->sum('quotations_count') }}</td>
        </tr>
    </tfoot>
</table>