<?php

namespace App\Http\Controllers\API\Outbound;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// Import Model
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Outbound\TransactionThree;
use App\Exports\Outbounds\TransactionThreeExport;

class OutboundThreeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index(Request $request)
    {
        // Record Activity
        $this->recordActivity('Akses Outbound Transaction 3');
        // Search Data
        $search = $request->get('search'); // Untuk Pencarian Global
        $search_part_number = $request->get('search_part_number'); // Untuk Pencarian Part Number
        $search_description = $request->get('search_description'); // Untuk Pencarian Description
        $search_quantity = $request->get('search_quantity'); // Untuk Pencarian Quantity
        $search_unit_measure = $request->get('search_unit_measure'); // Untuk Pencarian Kode Satuan
        $search_register_aircraft = $request->get('search_register_aircraft'); // Untuk Pencarian Register Aircraft
        $search_customer = $request->get('search_customer'); // Untuk Pencarian Customer
        $search_date_install = $request->get('search_date_install'); // Untuk Pencarian Date Install
        $search_date_aircraft_in = $request->get('search_date_aircraft_in'); // Untuk Pencarian Date Aircraft In
        $search_date_aircraft_out = $request->get('search_date_aircraft_out'); // Untuk Pencarian Date Aircraft Out
        $search_document_type = $request->get('search_document_type'); // Untuk Pencarian Type BC
        $search_submission_number = $request->get('search_submission_number'); // Untuk Pencarian Nomor Aju
        $search_submission_date = $request->get('search_submission_date'); // Untuk Pencarian Tanggal Aju
        $search_registration_number = $request->get('search_registration_number'); // Untuk Pencarian Nomor Daftar
        $search_registration_date = $request->get('search_registration_date'); // Untuk Pencarian Tanggal Daftar
        $search_cif_idr = $request->get('search_cif_idr'); // Untuk Pencarian CIF IDR

        // Filter Data
        $filter_start_date = $request->get('filter_start_date'); // Untuk Filter Tanggal Start Date
        $filter_end_date = $request->get('filter_end_date'); // Untuk Filter Tanggal End Date
        $filter_customer = $request->get('filter_customer'); // Untuk Filter Customer
        $filter_part_number = $request->get('filter_part_number'); // Untuk Filter Part Number
        $filter_submission_number = $request->get('filter_submission_number'); // Untuk Filter Nomor Aju
        $filter_submission_date = $request->get('filter_submission_date'); // Untuk Filter Tanggal Aju
        $filter_registration_number = $request->get('filter_registration_number'); // Untuk Filter Nomor Daftar
        $filter_registration_date = $request->get('filter_registration_date'); // Untuk Filter Tanggal Daftar
        $filter_document_type = $request->get('filter_document_type');  // Untuk Filter Type BC

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
        $outbounds  = TransactionThree::when($search, function ($query) use ($search) {
            $query->where(function ($sub_query) use ($search) {
                $sub_query->where('PART_NUMBER', 'LIKE', "%$search%")
                    ->orWhere('DESCRIPTION', 'LIKE', "%$search%")
                    ->orWhere('QUANTITY', 'LIKE', "%$search%")
                    ->orWhere('UNIT_MEASURE', 'LIKE', "%$search%")
                    ->orWhere('REGISTER_AIRCRAFT', 'LIKE', "%$search%")
                    ->orWhere('CUSTOMER', 'LIKE', "%$search%")
                    ->orWhere('DATE_INSTALL', 'LIKE', "%$search%")
                    ->orWhere('DATE_AIRCRAFT_IN', 'LIKE', "%$search%")
                    ->orWhere('DATE_AIRCRAFT_OUT', 'LIKE', "%$search%")
                    ->orWhere('TYPE_BC', 'LIKE', "%$search%")
                    ->orWhere('SUBMISSION_NUMBER', 'LIKE', "%$search%")
                    ->orWhere('SUBMISSION_DATE', 'LIKE', "%$search%")
                    ->orWhere('REGISTRATION_NUMBER', 'LIKE', "%$search%")
                    ->orWhere('REGISTRATION_DATE', 'LIKE', "%$search%")
                    ->orWhere('CIF_IDR', 'LIKE', "%$search%");
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
        })->when($search_date_aircraft_out, function ($query) use ($search_date_aircraft_out) {
            $query->whereDate('DATE_AIRCRAFT_OUT', "$search_date_aircraft_out");
        })->when($search_document_type, function ($query) use ($search_document_type) {
            $query->where('TYPE_BC', 'LIKE', "%$search_document_type%");
        })->when($search_submission_number, function ($query) use ($search_submission_number) {
            $query->where('SUBMISSION_NUMBER', 'LIKE', "%$search_submission_number%");
        })->when($search_submission_date, function ($query) use ($search_submission_date) {
            $query->whereDate('SUBMISSION_DATE', "$search_submission_date");
        })->when($search_registration_number, function ($query) use ($search_registration_number) {
            $query->where('REGISTRATION_NUMBER', 'LIKE', "%$search_registration_number%");
        })->when($search_registration_date, function ($query) use ($search_registration_date) {
            $query->whereDate('REGISTRATION_DATE', "$search_registration_date");
        })->when($search_cif_idr, function ($query) use ($search_cif_idr) {
            $query->where('CIF_IDR', 'LIKE', "%$search_cif_idr%");
        })->when($filter_start_date, function ($query) use ($filter_start_date) {
            $query->whereDate('DATE_INSTALL', '>=', $filter_start_date);
        })->when($filter_end_date, function ($query) use ($filter_end_date) {
            $query->whereDate('DATE_INSTALL', '<=', $filter_end_date);
        })->when($filter_customer, function ($query) use ($filter_customer) {
            $query->where('CUSTOMER', 'LIKE', "%$filter_customer%");
        })->when($filter_part_number, function ($query) use ($filter_part_number) {
            $query->where('PART_NUMBER', 'LIKE', "%$filter_part_number%");
        })->when($filter_submission_number, function ($query) use ($filter_submission_number) {
            $query->where('SUBMISSION_NUMBER', 'LIKE', "%$filter_submission_number%");
        })->when($filter_submission_date, function ($query) use ($filter_submission_date) {
            $query->whereDate('SUBMISSION_DATE', "$filter_submission_date");
        })->when($filter_registration_number, function ($query) use ($filter_registration_number) {
            $query->where('REGISTRATION_NUMBER', 'LIKE', "%$filter_registration_number%");
        })->when($filter_registration_date, function ($query) use ($filter_registration_date) {
            $query->whereDate('REGISTRATION_DATE', "$filter_registration_date");
        })->when($filter_document_type, function ($query) use ($filter_document_type) {
            $query->whereIn('TYPE_BC', $filter_document_type);
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
        return Excel::download(new TransactionThreeExport, 'outbound-transaction-three.csv');
    }

    public function exportExcel()
    {
        return Excel::download(new TransactionThreeExport, 'outbound-transaction-three.xlsx');
    }
}