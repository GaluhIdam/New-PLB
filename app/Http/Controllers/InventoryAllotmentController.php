<?php

namespace App\Http\Controllers;

use App\Models\InventoryAllotment;
use Illuminate\Http\Request;

class InventoryAllotmentController extends Controller
{
    use \App\Http\Traits\ActivityHistoryTrait;
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        $this->recordActivity('Akses Inventory Allotment');
        $search =  $request->get('search');
        $part_number =  $request->get('part_number');
        $from_plant =  $request->get('from_plant');
        $to_plant =  $request->get('to_plant');
        $unit_code =  $request->get('unit_code');
        //filter
        $filter_from_plant =  $request->get('filter_from_plant');


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

        $inventory_allotment = InventoryAllotment::when($search, function ($query) use ($search) {
            $query->where(function ($sub_query) use ($search) {
                $sub_query->where('part_number', 'LIKE', "%{$search}%")
                    ->orWhere('from_plant', 'LIKE', "%{$search}%")
                    ->orWhere('to_plant', 'LIKE', "%{$search}%")
                    ->orWhere('unit_code', 'LIKE', "%{$search}%");
            });
        })->when($part_number, function ($query) use ($part_number) {
            $query->where('part_number', 'LIKE', "%{$part_number}%");
        })->when($from_plant, function ($query) use ($from_plant) {
            $query->where('from_plant', 'LIKE', "%{$from_plant}%");
        })->when($to_plant, function ($query) use ($to_plant) {
            $query->where('to_plant', 'LIKE', "%{$to_plant}%");
        })->when($unit_code, function ($query) use ($unit_code) {
            $query->where('unit_code', 'LIKE', "%{$unit_code}%");
        })->when($filter_from_plant, function ($query) use ($filter_from_plant) {
            $query->where('from_plant', 'LIKE', "%{$filter_from_plant}%");
        })->when(($order && $by), function ($query) use ($order, $by) {
            $query->orderBy($order, $by);
        })->paginate($paginate);

        $query_string = [
            'search' => $search,
            'order' => $order,
            'by' => $by,
        ];

        $inventory_allotment->appends($query_string);

        return $inventory_allotment;
    }
}