@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1>Activity Logs</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-5">
                            <tr class="bg-info">
                                <td width="15%" style="min-width: 150px">Entity</td>
                                <td width="20%" style="min-width: 160px">Date</td>
                                <td style="min-width: 300px">Description</td>
                                <td style="min-width: 150px">User</td>
                            </tr>

                            @forelse ($activityLogs as $activityLog)
                                <tr>
                                    <td class="align-middle py-1 lh-sm">{{ $activityLog->entity_type }}</td>

                                    <td class="align-middle py-1 lh-sm">
                                        {{ $activityLog->created_at->format('Y, M d') }}
                                        <span class="text-info text-xs d-block">{{ $activityLog->created_at->format('(h:i a)') }}</span>
                                    </td>
                    
                                    <td class="align-middle py-1 lh-sm">
                                        <div class="d-flex align-items-center" style="min-height:40px">
                                            <div>
                                                {{ $activityLog->description }}

                                                <span class="text-sm text-info d-block">
                                                    {{ $activityLog->entity_details }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="align-middle py-1 lh-sm">{{ $activityLog->user->name ?? '' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No activity logs found</td>
                                </tr>
                            @endforelse
                        </table>
                    </div>

                    {{ $activityLogs->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection