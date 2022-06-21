<?php

namespace App\Http\Traits;

use Carbon\Carbon;
use App\Models\ActivityHistory;
use Illuminate\Support\Facades\Auth;

/**
 * 
 */
trait ActivityHistoryTrait
{
    public function recordActivity($activity)
    {
        $data = ActivityHistory::create([
            'username' => Auth::user()->username,
            'time' => Carbon::now(),
            'activity' => $activity,
        ]);

        return $data;
    }
}
