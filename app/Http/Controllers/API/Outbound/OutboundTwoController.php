<?php

namespace App\Http\Controllers\API\Outbound;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Outbound\TransactionTwo;
use App\Exports\Outbounds\TransactionTwoExport;

class OutboundTwoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index(Request $request)
    {
        // Record Activity
        $this->recordActivity('Akses Outbound Transaction 2');

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
        $search_submission_number = $request->get('search_submission_number'); // Untuk Pencarian Submission Number
        $search_submission_date = $request->get('search_submission_date'); // Untuk Pencarian Submission Date
        $search_ttd_date = $request->get('search_ttd_date'); // Untuk Pencarian TTD Date
        $search_cif_idr = $request->get('search_cif_idr'); // Untuk Pencarian CIF IDR 
        // Filter Data
        $filter_start_date = $request->get('filter_start_date'); // Untuk Filter Start Date
        $filter_end_date = $request->get('filter_end_date'); // Untuk Filter End Date
        $start_submission_date = $request->get('start_submission_date'); // Untuk Filter Tanggal Aju
        $end_submission_date = $request->get('end_submission_date'); // Untuk Filter Tanggal Aju
        $filter_document_type = $request->get('filter_document_type'); // Untuk Filter Type BC

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
        $outbounds = TransactionTwo::when($search, function ($query) use ($search) {
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
                    ->orWhere('TTD_DATE', 'LIKE', "%$search%")
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
            $query->where('DATE_INSTALL', 'LIKE', "%$search_date_install%");
        })->when($search_date_aircraft_in, function ($query) use ($search_date_aircraft_in) {
            $query->whereDate('DATE_AIRCRAFT_IN', "$search_date_aircraft_in");
        })->when($search_date_aircraft_out, function ($query) use ($search_date_aircraft_out) {
            $query->whereDate('DATE_AIRCRAFT_OUT', "$search_date_aircraft_out");
        })->when($search_document_type, function ($query) use ($search_document_type) {
            $query->where('TYPE_BC', 'LIKE', "%$search_document_type%");
        })->when($search_submission_number, function ($query) use ($search_submission_number) {
            $query->where('SUBMISSION_NUMBER', 'LIKE', "%$search_submission_number%");
        })->when($search_submission_date, function ($query) use ($search_submission_date) {
            $query->where('SUBMISSION_DATE', 'LIKE', "%$search_submission_date%");
        })->when($search_ttd_date, function ($query) use ($search_ttd_date) {
            $query->whereDate('TTD_DATE', $search_ttd_date);
        })->when($search_cif_idr, function ($query) use ($search_cif_idr) {
            $query->where('CIF_IDR', 'LIKE', "%$search_cif_idr%");
        })->when($filter_start_date, function ($query) use ($filter_start_date) {
            $query->whereDate('DATE_INSTALL', '>=', $filter_start_date);
        })->when($filter_end_date, function ($query) use ($filter_end_date) {
            $query->whereDate('DATE_INSTALL', '<=', $filter_end_date);
        })->when($start_submission_date, function ($query) use ($start_submission_date) {
            $query->whereDate('SUBMISSION_DATE', '>=', $start_submission_date);
        })->when($end_submission_date, function ($query) use ($end_submission_date) {
            $query->whereDate('SUBMISSION_DATE', '<=', $end_submission_date);
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

    public function exportCsv(Request $request)
    {
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
        $search_submission_number = $request->get('search_submission_number'); // Untuk Pencarian Submission Number
        $search_submission_date = $request->get('search_submission_date'); // Untuk Pencarian Submission Date
        $search_ttd_date = $request->get('search_ttd_date'); // Untuk Pencarian TTD Date
        $search_cif_idr = $request->get('search_cif_idr'); // Untuk Pencarian CIF IDR 
        // Filter Data
        $filter_start_date = $request->get('filter_start_date'); // Untuk Filter Start Date
        $filter_end_date = $request->get('filter_end_date'); // Untuk Filter End Date
        $start_submission_date = $request->get('start_submission_date'); // Untuk Filter Tanggal Aju
        $end_submission_date = $request->get('end_submission_date'); // Untuk Filter Tanggal Aju
        $filter_document_type = $request->get('filter_document_type'); // Untuk Filter Type BC

        // Sort Data
        if ($request->get('order') && $request->get('by')) {
            $order = $request->get('order');
            $by = $request->get('by');
        } else {
            $order = 'DATE_INSTALL';
            $by = 'desc';
        }

        return Excel::download(new TransactionTwoExport(
            $search,
            $search_part_number,
            $search_description,
            $search_quantity,
            $search_unit_measure,
            $search_register_aircraft,
            $search_customer,
            $search_date_install,
            $search_date_aircraft_in,
            $search_date_aircraft_out,
            $search_document_type,
            $search_submission_number,
            $search_submission_date,
            $search_ttd_date,
            $search_cif_idr,
            $filter_start_date,
            $filter_end_date,
            $start_submission_date,
            $end_submission_date,
            $filter_document_type,
            $order,
            $by
        ), 'outbound-transaction-two.csv');
    }

    public function exportExcel(Request $request)
    {
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
        $search_submission_number = $request->get('search_submission_number'); // Untuk Pencarian Submission Number
        $search_submission_date = $request->get('search_submission_date'); // Untuk Pencarian Submission Date
        $search_ttd_date = $request->get('search_ttd_date'); // Untuk Pencarian TTD Date
        $search_cif_idr = $request->get('search_cif_idr'); // Untuk Pencarian CIF IDR 
        // Filter Data
        $filter_start_date = $request->get('filter_start_date'); // Untuk Filter Start Date
        $filter_end_date = $request->get('filter_end_date'); // Untuk Filter End Date
        $start_submission_date = $request->get('start_submission_date'); // Untuk Filter Tanggal Aju
        $end_submission_date = $request->get('end_submission_date'); // Untuk Filter Tanggal Aju
        $filter_document_type = $request->get('filter_document_type'); // Untuk Filter Type BC

        // Sort Data
        if ($request->get('order') && $request->get('by')) {
            $order = $request->get('order');
            $by = $request->get('by');
        } else {
            $order = 'DATE_INSTALL';
            $by = 'desc';
        }

        return Excel::download(new TransactionTwoExport(
            $search,
            $search_part_number,
            $search_description,
            $search_quantity,
            $search_unit_measure,
            $search_register_aircraft,
            $search_customer,
            $search_date_install,
            $search_date_aircraft_in,
            $search_date_aircraft_out,
            $search_document_type,
            $search_submission_number,
            $search_submission_date,
            $search_ttd_date,
            $search_cif_idr,
            $filter_start_date,
            $filter_end_date,
            $start_submission_date,
            $end_submission_date,
            $filter_document_type,
            $order,
            $by
        ), 'outbound-transaction-two.xlsx');
    }
}