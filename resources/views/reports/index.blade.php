@extends('layouts.app')

@push('page_scripts')
    <script src="{{ asset('plugins/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('plugins/chart.js/datalabels.min.js') }}"></script>
    <script src="{{ asset('pages/reports/index.js?v=' . str_random(4)) }}"></script>

    <script>
        $(function() {
            let quotations = @json($quotations);

            let items = [];
            let counts = {};

            // for loop is the fastest way to iterate array
            for (let i = 0; i < quotations.length; i++) {
                let q = quotations[i];

                for (let j = 0; j < q.quotation_products.length; j++) {
                    let qp = q.quotation_products[j];

                    items.push(qp.product.product_type.product_name.product_brand.brand); 
                }   
            }

            for (let l = 0; l < items.length; l++) {
                let name = items[l];

                counts[name] = (counts[name] || 0) + 1
            }

            var quotationChartCanvas = $('#quotationChart').get(0).getContext('2d')

            var donutData = {
                labels: Object.keys(counts),
                datasets: [
                    {
                        data: Object.values(counts),
                        backgroundColor : ['#00a65a', '#3c8dbc', '#f56954', '#f39c12', '#00c0ef', '#d2d6de'],
                    }
                ]
            };

            var quotationOptions = {
                maintainAspectRatio : false,
                responsive : true,
                plugins: {
                    datalabels: {
                        display: true,
                        color: '#fff',
                        formatter: (value, context) => {
                            return context.chart.data.labels[context.dataIndex] + ': ' + value;
                        },
                    }
                },
            };

            new Chart(quotationChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: quotationOptions,
                plugins: [ChartDataLabels]
            });
        });
    </script>
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1>Report</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="col">
            <div class="row">
                <div class="col-xl-4">
                    <div class="row">
                        <div class="col-xl-12 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <form id='quotation-form'>
                                        <select id="year" name="year" class="form-control mb-2">
                                            @foreach ($years as $year)
                                                <option {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                            @endforeach
                                        </select>

                                        <select name="month" class="form-control mb-2">
                                            <option value="" selected>Select month</option>
                                
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}" {{ $i == request('month') ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                                            @endfor
                                        </select>

                                        <select id="created_by" name="created_by" class="form-control">
                                            <option value="" selected>Select sales executive</option>

                                            @foreach ($salesReps as $salesRep)
                                                <option value="{{ $salesRep->created_by }}" {{ $salesRep->created_by == request('created_by') ? 'selected' : '' }}>{{ $salesRep->createdBy->name }}</option>
                                            @endforeach
                                        </select>

                                        <div class="text-center mt-3">
                                            <input type="submit" class="btn btn-primary" value="Load">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-12 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="quotationChart" style="min-height: 220px; height: 220px; max-height: 220px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr class="bg-info">				
                                            <td class="align-middle text-center" width="10%">ORDER NO.</td>
                                            <td class="align-middle text-center" style="min-width: 120px" width="20%">DATE</td>
                                            <td class="align-middle text-center" style="min-width: 120px" >SALES REP.</td>
                                            <td class="align-middle text-center" style="min-width: 120px" >CLIENT NAME</td>
                                            <td class="align-middle text-center">PRODUCT TOTAL</td>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($paginated as $item)
                                            <tr>
                                                <td class="lh-1 text-center"><a target="_blank" href="{{ route('quotations.show', $item) }}">{{ $item->id }}</a></td>
                                                <td class="lh-1 text-center">
                                                    {{ $item->created_at->format('Y, M d') }}
                                                    <span class="text-xs d-block">{{ $item->created_at->format('(h:i a)') }}</span>
                                                </td>
                                                <td class="lh-1 text-center">{{ $item->createdBy->name }}</td>
                                                <td class="lh-1 text-center">{{ $item->name ?? '-' }}</td>
                                                <td class="lh-1 text-right"><span style="margin-right: 2px">₱</span>{{ number_format($item->total_product_cost, 2) }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No quotations found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>

                                    <tfoot>
                                        <tr class="bg-info">
                                            <td colspan="2">Count: {{ $quotations->count() }}</td>
                                            <td colspan="3" class="text-right"><span style="margin-right: 2px">₱</span>{{ number_format($quotations->sum('total_product_cost'), 2) }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection