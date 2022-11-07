<?php

namespace App\Http\Controllers\API\Outbound;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Import Model
use App\Models\Outbound\TransactionOne;

class OutboundOneController extends Controller
{
    /* 
    List Data yang dimunculin : 
    1. Part Number [$part_number]
    2. Description [$description]
    3. Quantity [$quantity]
    4. Kode Satuan [$unit_measure]
    5. Register Aircraft [$register_aircraft]
    6. Customer [$customer]
    7. Date Install [$date_install]
    8. Date Aircraft In [$date_aircraft_in]
    9. Kode Dokumen Kepabeanan [$document_type]
    */

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        // Record Activity
        $this->recordActivity('Akses Outbound Transaction 1');

        // Search
        $search = $request->get('search'); // Untuk Pencarian
        $search_part_number = $request->get('search_part_number'); // Untuk Pencarian Part Number
        $search_description = $request->get('search_description'); // Untuk Pencarian Description
        $search_quantity = $request->get('search_quantity'); // Untuk Pencarian Quantity
        $search_unit_measure = $request->get('search_unit_measure'); // Untuk Pencarian Unit Measure (Kode Satuan)
        $search_register_aircraft = $request->get('search_register_aircraft'); // Untuk Pencarian Register Aircraft
        $search_customer = $request->get('search_customer'); // Untuk Pencarian Customer
        $search_date_install = $request->get('search_date_install'); // Untuk Pencarian Date Install
        $search_date_aircraft_in = $request->get('search_date_aircraft_in'); // Untuk Pencarian Date Aircraft In

        // Filter Data
        $filter_start_date = $request->get('filter_start_date'); // Untuk Filter Tanggal Start Date
        $filter_end_date = $request->get('filter_end_date'); // Untuk Filter Tanggal End Date
        $filter_customer = $request->get('filter_customer'); // Untuk Filter customer
        $filter_part_number = $request->get('filter_part_number'); // Untuk Filter Part Number
        $filter_document_type = $request->get('filter_document_type'); // Untuk Filter Kode Dokumen Kepabeanan

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
        $outbounds  = TransactionOne::when($search, function ($query) use ($search) {
            $query->where(function ($sub_query) use ($search) {
                $sub_query->where('KODE_DOKUMEN_PABEAN', 'LIKE', "%$search%")
                    ->orWhere('PART_NUMBER', 'LIKE', "%$search%")
                    ->orWhere('DESCRIPTION', 'LIKE', "%{$search}%")
                    ->orWhere('QUANTITY', 'LIKE', "%$search%")
                    ->orWhere('UNIT_MEASURE', 'LIKE', "%$search%")
                    ->orWhere('REGISTER_AIRCRAFT', 'LIKE', "%$search%")
                    ->orWhere('CUSTOMER', 'LIKE', "%$search%")
                    ->orWhere('DATE_INSTALL', 'LIKE', "%$search%")
                    ->orWhere('DATE_AIRCRAFT_IN', 'LIKE', "%$search%");
            });
        })->when($search_part_number, function ($query) use ($search_part_number) {
            $query->where('PART_NUMBER', 'LIKE', "%$search_part_number%");
        })->when($search_description, function ($query) use ($search_description) {
            $query->where('DESCRIPTION', 'LIKE', "%$search_description%");
        })->when($search_quantity, function ($query) use ($search_quantity) {
            $query->where('QUANTITY', 'LIKE', "%$search_quantity%");
        })->when($search_unit_measure, function ($query) use ($search_unit_measure) {
            $query->where('UNIT_MEASURE', 'LIKE', "%$search_unit_measure%");
        })->when($search_register_aircraft, function ($query) use ($search_register_aircraft) {
            $query->where('REGISTER_AIRCRAFT', 'LIKE', "%$search_register_aircraft%");
        })->when($search_customer, function ($query) use ($search_customer) {
            $query->where('CUSTOMER', 'LIKE', "%$search_customer%");
        })->when($search_date_install, function ($query) use ($search_date_install) {
            $query->whereDate('DATE_INSTALL', "$search_date_install");
        })->when($search_date_aircraft_in, function ($query) use ($search_date_aircraft_in) {
            $query->whereDate('DATE_AIRCRAFT_IN', "$search_date_aircraft_in");
        })->when($filter_start_date, function ($query) use ($filter_start_date) {
            $query->where('DATE_INSTALL', '>=', $filter_start_date);
        })->when($filter_end_date, function ($query) use ($filter_end_date) {
            $query->where('DATE_INSTALL', '<=', $filter_end_date);
        })->when($filter_customer, function ($query) use ($filter_customer) {
            $query->where('CUSTOMER', 'LIKE', "%$filter_customer%");
        })->when($filter_part_number, function ($query) use ($filter_part_number) {
            $query->where('PART_NUMBER', 'LIKE', "%$filter_part_number%");
        })->when($filter_document_type, function ($query) use ($filter_document_type) {
            $query->whereIn('KODE_DOKUMEN_PABEAN', $filter_document_type);
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
}