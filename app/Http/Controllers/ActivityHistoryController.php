<?php

namespace App\Http\Controllers;

use App\Models\ActivityHistory;
use App\Http\Requests\StoreActivityHistoryRequest;
use App\Http\Requests\UpdateActivityHistoryRequest;
use Illuminate\Http\Request;
use App\Http\Traits\ActivityHistoryTrait;

class ActivityHistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    use ActivityHistoryTrait;

    public function index(Request $request)
    {
        $this->recordActivity('tes');

        $search = $request->keyword;
        if ($request->order && $request->by) {
            $order = $request->order;
            $by = $request->by;
        } else {
            $order = 'id';
            $by = 'desc';
        }
        $activityHistory = ActivityHistory::when($search, function ($query) use ($search) {
            $query->where(function ($sub_query) use ($search) {
                $sub_query->where('username', 'LIKE', "%{$search}%")
                    ->orWhere('time', 'LIKE', "%{$search}%")
                    ->orWhere('activity', 'LIKE', "%{$search}%");
            });
        })->when(($order && $by), function ($query) use ($order, $by) {
            $query->orderBy($order, $by);
        })->paginate(10);

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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreActivityHistoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActivityHistoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ActivityHistory  $activityHistory
     * @return \Illuminate\Http\Response
     */
    public function show(ActivityHistory $activityHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ActivityHistory  $activityHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(ActivityHistory $activityHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateActivityHistoryRequest  $request
     * @param  \App\Models\ActivityHistory  $activityHistory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateActivityHistoryRequest $request, ActivityHistory $activityHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ActivityHistory  $activityHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActivityHistory $activityHistory)
    {
        //
    }
}
