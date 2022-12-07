<?php

namespace App\Http\Controllers\API\Outbound;

use Illuminate\Http\Request;
use App\Models\Outbound\Summary;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Outbounds\SummaryExport;

class OutboundSummaryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index(Request $request)
    {
        // Record Activity
        $this->recordActivity('Akses Outbound Transaction 2');

        // Seach Data
        $search = $request->get('search'); // Untuk Pencarian Global
        $search_part_number = $request->get('search_part_number'); // Untuk Pencarian Part Number
        $search_condition = $request->get('search_condition'); // Untuk Pencarian Kondisi
        $search_quantity = $request->get('search_quantity'); // Untuk Pencarian Quantity
        $search_cif_idr = $request->get('search_cif_idr'); // Untuk Pencarian CIF IDR

        // Filter Data
        $filter_start_date = $request->get('filter_start_date'); // Untuk Filter Tanggal Start Date
        $filter_end_date = $request->get('filter_end_date'); // Untuk Filter Tanggal End Date
        $filter_part_number = $request->get('filter_part_number'); // Untuk Filter Part Number

        // Sort Data
        if ($request->get('order') && $request->get('by')) {
            $order = $request->get('order');
            $by = $request->get('by');
        } else {
            $order = 'DATE_INSTALL';
            $by = 'desc';
        }

        // Paginate Data
        if ($request->get('paginate')) {
            $paginate = $request->get('paginate');
        } else {
            $paginate = 10;
        }

        // Query Untuk Menampilkan Data
        $outbounds  = Summary::when($search, function ($query) use ($search) {
            $query->where(function ($sub_query) use ($search) {
                $sub_query->where('PART_NUMBER', 'LIKE', "%$search%")
                    ->orWhere('QUANTITY', 'LIKE', "%$search%")
                    ->orWhere('DATE_INSTALL', 'LIKE', "%$search%")
                    ->orWhere('CIF_IDR', 'LIKE', "%$search%");
            });
        })->when($search_part_number, function ($query) use ($search_part_number) {
            $query->where('PART_NUMBER', 'LIKE', "%$search_part_number%");
        })->when($search_quantity, function ($query) use ($search_quantity) {
            $query->where('QUANTITY', 'LIKE', "%$search_quantity%");
        })->when($search_cif_idr, function ($query) use ($search_cif_idr) {
            $query->where('CIF_IDR', 'LIKE', "%$search_cif_idr%");
        })->when($filter_start_date, function ($query) use ($filter_start_date) {
            $query->whereDate('DATE_INSTALL', '>=', $filter_start_date);
        })->when($filter_end_date, function ($query) use ($filter_end_date) {
            $query->whereDate('DATE_INSTALL', '<=', $filter_end_date);
        })->when($filter_part_number, function ($query) use ($filter_part_number) {
            $query->where('PART_NUMBER', 'LIKE', "%$filter_part_number%");
        })->when(($order && $by), function ($query) use ($order, $by) {
            $query->orderBy($order, $by);
        })->paginate($paginate);

        $result = [
            'search' => $search,
            'order' => $order,
            'by' => $by,
            'paginate' => $paginate,
        ];

        $outbounds->appends($result);
        return $outbounds;
    }

    public function exportCsv()
    {
        return Excel::download(new SummaryExport, 'outbound-summary.csv');
    }

    public function exportExcel()
    {
        return Excel::download(new SummaryExport, 'outbound-summary.xlsx');
    }
}