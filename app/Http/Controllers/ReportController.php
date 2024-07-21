<?php

namespace App\Http\Controllers;

use App\Quotation;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('userType:1');
    }

    public function index() {
        $quotations = Quotation::where('approved_at', '<>', null)->whereYear('created_at', request('year') ?? date('Y'));

        if (request('month')) {
            $quotations->whereMonth('created_at', request('month'));
        }

        $salesReps = (clone $quotations)->groupBy('created_by')->get('created_by')->sortBy('createdBy.name');

        if (request('created_by')) {
            $quotations->where('created_by', request('created_by'));
        }

        $paginated  = (clone $quotations)->paginate();
        $quotations = $quotations->with('quotationProducts.product.productType.productName.productBrand')->get(['id']);

        return view('reports.index', compact('quotations', 'paginated', 'salesReps'));
    }
}
