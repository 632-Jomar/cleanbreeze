<?php

namespace App\Http\Controllers;

use App\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function __construct()
    {
        $this->middleware('userType:1,2');
    }

    public function index() {
        $activityLogs = ActivityLog::all();

        // foreach ($activityLogs as $key => $activityLog) {
        //     if ($activityLog->entity_type == 'Product') {
        //         $entityId = str_after($activityLog->description, '(Product ID: ');
        //         $entityId = str_before($entityId, ')');

        //         $activityLog->update(['entity_id' => $entityId]);
        //     }
        // }
        // die;

        $activityLogs = ActivityLog::latest()->paginate(10);

        return view('activity-logs.index', compact('activityLogs'));
    }
}
