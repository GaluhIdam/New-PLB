<?php

namespace App\Http\Controllers;

use App\Models\MovementAllotment;
use Illuminate\Http\Request;

class MovementAllotmentController extends Controller
{
    use \App\Http\Traits\ActivityHistoryTrait;
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index(Request $request)
    {
        $this->recordActivity('Akses Movement Allotment');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');

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

        $movement_allotment = MovementAllotment::when($from_date && $to_date, function ($query) use ($from_date, $to_date) {
            $query->whereBetween('date', [$from_date, $to_date]);
        })->when(($order && $by), function ($query) use ($order, $by) {
            $query->orderBy($order, $by);
        })->paginate($paginate);


        $query_string = [
            'order' => $order,
            'by' => $by,
        ];

        $movement_allotment->appends($query_string);

        return $movement_allotment;
    }
}