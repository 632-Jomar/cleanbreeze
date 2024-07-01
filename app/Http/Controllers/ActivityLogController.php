<?php

namespace App\Http\Controllers;

use App\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index() {
        $activityLogs = ActivityLog::latest()->paginate(10);

        return view('activity-logs.index', compact('activityLogs'));
    }
}
