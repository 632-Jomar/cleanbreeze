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
        $quotations = Quotation::where('approved_at', '<>', null)->paginate();
        return view('reports.index', compact('quotations'));
    }
}
