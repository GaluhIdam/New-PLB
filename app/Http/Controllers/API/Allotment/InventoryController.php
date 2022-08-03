<?php

namespace App\Http\Controllers\API\Allotment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Import Model
use App\Models\Allotment\InventoryAllotment;

class InventoryController extends Controller
{
    /* 
    List Data yang dimunculin : 
    1. Part Number [$part_number]
    2. Plant [$plant]
    3. Material Document [$material_document]
    4. Total [$total]
    5. Kode Satuan [$unit_measure]
    */
    public function inventoryAllotment(Request $request)
    {
        // Query untuk Sortir Data
        $search = $request->get('search'); // Untuk Pencarian
        $part_number = $request->get('search_part_number'); // Untuk Pencarian Part Number
        $plant = $request->get('search_plant'); // Untuk Pencarian Plant
        $material_document = $request->get('search_material_document'); // Untuk Pencarian Material Document
        $total = $request->get('search_total'); // Untuk Pencarian Total
        $unit_measure = $request->get('search_unit_measure'); // Untuk Pencarian Kode Satuan

        // Filter Data
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
        $inventory = InventoryAllotment::when($search, function ($query) use ($search) {
            $query->where(function ($sub_query) use ($search) {
                $sub_query->where('part_number', 'LIKE', "%$search%")
                    ->orWhere('plant', 'LIKE', "%$search%")
                    ->orWhere('material_document', 'LIKE', "%$search%")
                    ->orWhere('total', 'LIKE', "%$search%")
                    ->orWhere('unit_measure', 'LIKE', "%$search%");
            });
        })->when($part_number, function ($query) use ($part_number) {
            $query->where('part_number', 'LIKE', "%$part_number%");
        })->when($plant, function ($query) use ($plant) {
            $query->where('plant', 'LIKE', "%$plant%");
        })->when($material_document, function ($query) use ($material_document) {
            $query->where('material_document', 'LIKE', "%$material_document%");
        })->when($total, function ($query) use ($total) {
            $query->where('total', 'LIKE', "%$total%");
        })->when($unit_measure, function ($query) use ($unit_measure) {
            $query->where('unit_measure', 'LIKE', "%$unit_measure%");
        })->when($filter_plant, function ($query) use ($filter_plant) {
            $query->where('plant', 'LIKE', "%$filter_plant%");
        })->when(($order && $by), function ($query) use ($order, $by) {
            $query->orderBy($order, $by);
        })->paginate($paginate);

        $result = [
            'search' => $search,
            'order' => $order,
            'by' => $by,
        ];

        $inventory->appends($result);
        return $inventory;
    }
}