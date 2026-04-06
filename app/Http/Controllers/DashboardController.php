<?php

namespace App\Http\Controllers;

use App\Product;
use App\Quotation;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('userType:1,2');
    }

    public function index() {
        if (auth()->user()->user_type_id == 1) {
            $counts = [
                'quotations' => Quotation::where('approved_at', '<>', null)->count(),
                'users'      => User::count(),
                'products'   => Product::count(),
                'revisions'  => Quotation::withTrashed()->where('revised_by', '<>', null)->count()
            ];

            $quotationData = $this->getQuotationData();
            $users         = $this->getSummaryUsers();

            return view('dashboard.admin.index', compact('counts', 'quotationData', 'users'));
        }

        $counts = [
            'quotations' => Quotation::where('created_by', auth()->id())->where('approved_at', '<>', null)->count(),
            'revisions'  => Quotation::withTrashed()->where('revised_by', auth()->id())->count(),
        ];

        $quotationData = $this->getQuotationData();

        return view('dashboard.user.index', compact('counts', 'quotationData'));
    }

    public function getQuotationData() {
        $quotationData = [];
        $monthsCount   = 12;

        $quotations = Quotation::where('approved_at', '<>', null);
        
        if (auth()->user()->user_type_id != 1) {
            $quotations->where('created_by', auth()->id());
        }

        $fromYear = (int) (request('year') ?? date('Y'));
        $toYears  = request('to_year') ?? [$fromYear - 1];
        $years    = [$fromYear];
        
        if (count($toYears)) {
            foreach ($toYears as $key => $toYear) {
                array_push($years, (int) $toYear);
            }
        }

        $years = array_unique($years);
        rsort($years);

        foreach ($years as $key => $year) {
            $quotationYear = (clone $quotations)->whereYear('created_at', $year);

            if ($quotationYear->count()) {
                $quotationData[$key]['year'] = $year;

                for ($i=0; $i < $monthsCount; $i++) {
                    $quotationData[$key]['data'][] = (clone $quotationYear)->whereMonth('created_at', ($i+1))->count();
                }
            }
        }

        return $quotationData;
    }

    public function getSummaryUsers() {
        $summaryYear            = request('summary_year');
        $withArchivedQuotations = request('with_archived_quotations');
        $withArchivedUsers      = request('with_archived_users');

        $users = $users = User::where('email_verified_at', '<>', null)
            ->where('user_type_id', '<>', 1)
            ->whereNotIn('email', User::SUPER_ADMINS);

        if (!request()->ajax() || $withArchivedUsers) {
            $users = $users->withTrashed();
        }

        $users = $users->withCount([
            'approvedQuotations' => function($query) use($summaryYear, $withArchivedQuotations) {
                if (!request()->ajax() || $withArchivedQuotations) {
                    $query->withTrashed();
                }

                if ($summaryYear) {
                    $query->whereYear('created_at', $summaryYear);
                }
            },

            'revisedQuotations' => function($query) use($summaryYear, $withArchivedQuotations) {
                if (!request()->ajax() || $withArchivedQuotations) {
                    $query->withTrashed();
                }

                if ($summaryYear) {
                    $query->whereYear('created_at', $summaryYear);
                }
            },

            'quotations' => function($query) use($summaryYear, $withArchivedQuotations) {
                if (!request()->ajax() || $withArchivedQuotations) {
                    $query->withTrashed();
                }

                if ($summaryYear) {
                    $query->whereYear('created_at', $summaryYear);
                }
            }
        ])
        ->orderBy('approved_quotations_count', 'desc')
        ->orderBy('name')
        ->get();

        if (request()->ajax()) {
            return response([
                'message' => null,
                'view'    => view('dashboard.admin.summary-users', compact('users'))->render()
            ]);
        }

        return $users;
    }
}
