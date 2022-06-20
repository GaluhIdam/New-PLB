<?php

namespace App\Http\Traits;

use App\Models\ActivityHistory;
use Illuminate\Http\Request;

/**
 * 
 */
trait ActivityHistoryTrait
{
    public function recordActivity(Request $request)
    {
        $data = ActivityHistory::create([
            'username' => $request->username,
            'time' => date('Y-m-d H:i:s'),
            'activity' => $request->activity,
        ]);

        return $data;
    }
}
