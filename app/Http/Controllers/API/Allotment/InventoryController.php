<?php

namespace App\Http\Controllers\API\Allotment;

use Illuminate\Http\Request;
use App\Models\Allotment\Inventory;
// Import Model
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Allotment\InventoryExport;

class InventoryController extends Controller
{
    /* 
    List Data yang dimunculin : 
    1. Part Number [$part_number]
    2. Plant Asal [$plant_origin]
    3. Plant Tujuan [$plant_destination]
    4. Quantity [$quantity]
    5. Kode Satuan [$unit_measure]
    */
    use \App\Http\Traits\ActivityHistoryTrait;
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        $this->recordActivity('Akses Inventory Allotment');

        // Query Search Data
        $search = $request->get('search'); // Untuk Pencarian
        $search_part_number = $request->get('search_part_number'); // Untuk Pencarian
        $search_plant_origin = $request->get('search_plant_origin'); // Untuk Pencarian Plant Asal
        $search_plant_destination = $request->get('search_plant_destination'); // Untuk Pencarian Plant Tujuan
        $search_quantity = $request->get('search_quantity'); // Untuk Pencarian Quantity
        $search_unit_measure = $request->get('search_unit_measure'); // Untuk Pencarian Kode Satuan

        // Query Filter Data
        $filter_plant = $request->get('filter_plant'); // Untuk Filter Plant

        // Sort Data
        if ($request->get('order') && $request->get('by')) {
            $order = $request->get('order');
            $by = $request->get('by');
        } else {
            $order = 'id';
            $by = 'desc';
        }
        // Paginate Data
        if ($request->get('paginate')) {
            $paginate = $request->get('paginate');
        } else {
            $paginate = 10;
        }

        // Query untuk Menampilkan Data
        $inventory = Inventory::when($search, function ($query) use ($search) {
            $query->where(function ($sub_query) use ($search) {
                $sub_query->where('PART_NUMBER', 'LIKE', "%$search%")
                    ->orWhere('PLANT_ORIGIN', 'LIKE', "%$search%")
                    ->orWhere('PLANT_DESTINATION', 'LIKE', "%$search%")
                    ->orWhere('QUANTITY', 'LIKE', "%$search%")
                    ->orWhere('UNIT_MEASURE', 'LIKE', "%$search%");
            });
        })->when($search_part_number, function ($query) use ($search_part_number) {
            $query->where('PART_NUMBER', 'LIKE', "%$search_part_number%");
        })->when($search_plant_origin, function ($query) use ($search_plant_origin) {
            $query->where('PLANT_ORIGIN', 'LIKE', "%$search_plant_origin%");
        })->when($search_plant_destination, function ($query) use ($search_plant_destination) {
            $query->where('PLANT_DESTINATION', 'LIKE', "%$search_plant_destination%");
        })->when($search_quantity, function ($query) use ($search_quantity) {
            $query->where('QUANTITY', 'LIKE', "%$search_quantity%");
        })->when($search_unit_measure, function ($query) use ($search_unit_measure) {
            $query->where('UNIT_MEASURE', 'LIKE', "%$search_unit_measure%");
        })->when($filter_plant, function ($query) use ($filter_plant) {
            $query->where('plant', 'LIKE', "%$filter_plant%");
        })->when(($order && $by), function ($query) use ($order, $by) {
            $query->orderBy($order, $by);
        })->paginate($paginate);

        $result = [
            'search' => $search,
            'order' => $order,
            'by' => $by,
            'paginate' => $paginate,
        ];

        $inventory->appends($result);
        return $inventory;
    }

    public function exportCsv(Request $request)
    {
        // Query Search Data
        $search = $request->get('search'); // Untuk Pencarian
        $search_part_number = $request->get('search_part_number'); // Untuk Pencarian
        $search_plant_origin = $request->get('search_plant_origin'); // Untuk Pencarian Plant Asal
        $search_plant_destination = $request->get('search_plant_destination'); // Untuk Pencarian Plant Tujuan
        $search_quantity = $request->get('search_quantity'); // Untuk Pencarian Quantity
        $search_unit_measure = $request->get('search_unit_measure'); // Untuk Pencarian Kode Satuan

        // Query Filter Data
        $filter_plant = $request->get('filter_plant'); // Untuk Filter Plant

        // Sort Data
        if ($request->get('order') && $request->get('by')) {
            $order = $request->get('order');
            $by = $request->get('by');
        } else {
            $order = 'id';
            $by = 'desc';
        }

        return Excel::download(new InventoryExport(
            $search,
            $search_part_number,
            $search_plant_origin,
            $search_plant_destination,
            $search_quantity,
            $search_unit_measure,
            $filter_plant,
            $order,
            $by
        ), 'inventory-allotment.csv');
    }
}