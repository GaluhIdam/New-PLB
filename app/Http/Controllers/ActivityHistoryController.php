<?php

namespace App\Http\Controllers;

use App\Models\ActivityHistory;
use Illuminate\Http\Request;

class ActivityHistoryController extends Controller
{
    use \App\Http\Traits\ActivityHistoryTrait;
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function index(Request $request)
    {
        $this->recordActivity('tes');

        $search  = $request->get('search');
        $search_username = $request->get('search_username');
        $search_time = $request->get('search_time');
        $search_activity = $request->get('search_activity');

        if ($request->get('order') && $request->get('by')) {
            $order = $request->get('order');
            $by = $request->get('by');
        } else {
            $order = 'id';
            $by = 'desc';
        }

        if ($request->get('paginate')) {
            $paginate = $request->get('paginate');
        } else {
            $paginate = 10;
        }

        $activityHistory = ActivityHistory::when($search, function ($query) use ($search) {
            $query->where(function ($sub_query) use ($search) {
                $sub_query->where('username', 'LIKE', "%{$search}%")
                    ->orWhere('time', 'LIKE', "%{$search}%")
                    ->orWhere('activity', 'LIKE', "%{$search}%");
            });
        })->when($search_username, function ($query) use ($search_username) {
            $query->where('username', 'LIKE', "%{$search_username}%");
        })->when($search_time, function ($query) use ($search_time) {
            $query->where('time', 'LIKE', "%{$search_time}%");
        })->when($search_activity, function ($query) use ($search_activity) {
            $query->where('activity', 'LIKE', "%{$search_activity}%");
        })->when(($order && $by), function ($query) use ($order, $by) {
            $query->orderBy($order, $by);
        })->paginate($paginate);

        $query_string = [
            'search' => $search,
            'order' => $order,
            'by' => $by,
        ];

        $activityHistory->appends($query_string);

        return $activityHistory;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
}
