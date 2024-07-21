<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;

class QuotationApiController extends Controller
{
    public function getSalesReps($year = null) {
        $users = User::orderBy('name')->whereHas('quotations', function($query) use ($year) {
            $query->where('approved_at', '<>', null)->whereYear('created_at', $year ?? date('Y'));
        })->get();

        return $users;
    }
}