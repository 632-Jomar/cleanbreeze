@extends('layouts.app')

@push('page_scripts')
    <script src="{{ asset('plugins/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('plugins/chart.js/datalabels.min.js') }}"></script>
    <script src="{{ asset('pages/dashboard/admin/index.js?v=' . str_random(4)) }}"></script>

    <script>
        $(function() {
            let datasets = [];
            let quotationData = @json($quotationData);

            var quotationChartCanvas = $('#quotationChart').get(0).getContext('2d');
            
            var colors = [
                ['#17a2b8', '#17a2b8'], // info
                ['#28a745', '#28a745'], // success
                ['#dc3545', '#dc3545'], // danger
                ['#007bff', '#007bff'], // primary
                ['#6c757d', '#6c757d'], // secondary
                ['#ffc107', '#ffc107'], // warning
            ];

            for (let index = 0; index < quotationData.length; index++) {
                datasets.push({
                    label: quotationData[index]['year'],
                    data:  quotationData[index]['data'],

                    backgroundColor: colors[index][0],
                    borderColor: colors[index][1]
                });
            }

            var barChartData = {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: datasets
            };

            var barChartOptions = {
                responsive          : true,
                maintainAspectRatio : false,
                datasetFill         : false,

                layout: {
                    padding: {
                        right: 5
                    }
                },

                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                if (Number.isInteger(value)) {
                                    return value;
                                }
                            }
                        }
                    }
                }
            };

            new Chart(quotationChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            });
        });
    </script>
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="col">
            <div class="row">
                <div class="col-xl-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $counts['quotations'] }}</h3>
                            <p>Approved Quotations</p>
                        </div>

                        <div class="icon">
                            <i class="fa fa-chart-bar"></i>
                        </div>

                        <a href="{{ route('quotations.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-xl-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $counts['products'] }}</h3>
                            <p>Products</p>
                        </div>

                        <div class="icon">
                            <i class="fa fa-fan"></i>
                        </div>

                        <a href="{{ route('products.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-xl-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $counts['users'] }}</h3>
                            <p>Users</p>
                        </div>

                        <div class="icon">
                            <i class="fa fa-user-tie"></i>
                        </div>

                        <a href="{{ route('accounts.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-xl-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $counts['revisions'] }}</h3>
                            <p>Revisions</p>
                        </div>

                        <div class="icon">
                            <i class="fa fa-pen-square"></i>
                        </div>

                        <a href="#" class="small-box-footer invisible">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <canvas id="quotationChart" style="min-height: 220px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card card-info">
                        <div class="card-header">Summary (Users)</div>
                        <div class="card-body">
                            <form id="form_summary">
                                <div class="row align-items-center text-center mb-3">
                                    <div class="col-4 lh-1">
                                        <input role="button" class="summary_input" type="checkbox" name="with_archived_quotations" id="with_archived_quotations" value="1" checked>
                                        <label role="button" class="m-0 font-weight-normal user-select-none" for="with_archived_quotations">With Archived Quotations</label>
                                    </div>

                                    <div class="col-4 lh-1">
                                        <input role="button" class="summary_input" type="checkbox" name="with_archived_users" id="with_archived_users" value="1" checked>
                                        <label role="button" class="m-0 font-weight-normal user-select-none" for="with_archived_users">With Archived Users</label>
                                    </div>

                                    <div class="col-4">
                                        <select class="form-control mx-auto summary_input" name="summary_year" style="width: 120px">
                                            <option value="">All</option>
            
                                            @foreach ($quotationData as $quotationItem)
                                                <option>{{ $quotationItem['year'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- <div class="mr-2">
                                        <button class="btn btn-primary btn-block">Submit</button>
                                    </div> --}}
                                </div>
                            </form>

                            <div class="table-responsive" id="table_summary">
                                @include('dashboard.admin.summary-users')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection