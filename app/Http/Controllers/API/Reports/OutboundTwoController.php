<?php

namespace App\Http\Controllers\API\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Import Model
use App\Models\Reports\OutboundTransaction;

class OutboundTwoController extends Controller
{
    /* 
    List Data yang dimunculin : 
    1. Part Number [$part_number]
    2. Description [$description]
    3. Quantity [$quantity]
    4. Kode Satuan [$unit_measure]
    5. Register Aircraft [$register_aircraft]
    6. customer [$customer]
    7. Date Install [$date_install]
    8. Date Aircraft In [$date_aircraft_in]
    9. Date Aircraft Out [$date_aircraft_out]
    10. Type BC [$document_type]
    11. Nomor Aju [$submission_number]
    12. Tanggal Aju [$submission_date]
    13. Nomor Daftar
    14. Tanggal Daftar
    15. CIF IDR
    16. BM Bayar
    17. PPn Bayar
    18. PPh Bayar
    */
    public function OutboundTwo(Request $request)
    {
        // Query untuk Sortir Data
        $search = $request->get('search'); // Untuk Pencarian
        $part_number = $request->get('search_part_number'); // Untuk Pencarian Part Number
        $description = $request->get('search_description'); // Untuk Pencarian Description
        $quantity = $request->get('search_quantity'); // Untuk Pencarian Quantity
        $unit_measure = $request->get('search_unit_measure'); // Untuk Pencarian Kode Satuan
        $register_aircraft = $request->get('search_register_aircraft'); // Untuk Pencarian Register Aircraft
        $customer = $request->get('search_customer'); // Untuk Pencarian customer
        $date_install = $request->get('search_date_install'); // Untuk Pencarian Install Date
        $date_aircraft_in = $request->get('search_date_aircraft_in'); // Untuk Pencarian Aircraft In Date
        $date_aircraft_out = $request->get('search_date_aircraft_out'); // Untuk Pencarian Aircraft Out Date
        $document_type = $request->get('search_document_type'); // Untuk Pencarian Type BC
        $submission_number = $request->get('search_submission_number'); // Untuk Pencarian Nomor Aju
        $submission_date = $request->get('search_submission_date'); // Untuk Pencarian Tanggal Aju
        $registration_number = $request->get('search_registration_number'); // Untuk Pencarian Nomor Daftar
        $registration_date = $request->get('search_registration_date'); // Untuk Pencarian Tanggal Daftar
        $due_date = $request->get('search_due_date'); // Untuk Pencarian Due Date
        $cif_idr = $request->get('search_cif_idr'); // Untuk Pencarian CIF IDR
        $bm_bayar = $request->get('search_bm_bayar'); // Untuk Pencarian BM Bayar
        $ppn_bayar = $request->get('search_ppn_bayar'); // Untuk Pencarian PPn Bayar
        $pph_bayar = $request->get('search_pph_bayar'); // Untuk Pencarian PPh Bayar

        // Filter
        $filter_start_date = $request->get('filter_start_date');
        $filter_end_date = $request->get('filter_end_date');
        $filter_customer = $request->get('filter_customer');
        $filter_part_number = $request->get('filter_part_number');
        $filter_submission_number = $request->get('filter_submission_number');
        $filter_submission_date = $request->get('filter_submission_date');
        $filter_document_type = $request->get('filter_document_type');

        // Sort Data
        if ($request->get('order') && $request->get('by')) {
            $order = $request->get('order');
            $by = $request->get('by');
        } else {
            $order = 'date_install';
            $by = 'desc';
        }

        // Paginate Data
        if ($request->get('paginate')) {
            $paginate = $request->get('paginate');
        } else {
            $paginate = 10;
        }

        // Query Untuk Menampilkan Data
        $outbounds  = OutboundTransaction::when($search, function ($query) use ($search) {
            $query->where(function ($sub_query) use ($search) {
                $sub_query->where('part_number', 'LIKE', "%$search%")
                    ->orWhere('description', 'LIKE', "%$search%")
                    ->orWhere('quantity', 'LIKE', "%$search%")
                    ->orWhere('unit_measure', 'LIKE', "%$search%")
                    ->orWhere('register_aircraft', 'LIKE', "%$search%")
                    ->orWhere('customer', 'LIKE', "%$search%")
                    ->orWhere('date_install', 'LIKE', "%$search%")
                    ->orWhere('date_aircraft_in', 'LIKE', "%$search%")
                    ->orWhere('date_aircraft_out', 'LIKE', "%$search%")
                    ->orWhere('document_type', 'LIKE', "%$search%")
                    ->orWhere('submission_number', 'LIKE', "%$search%")
                    ->orWhere('submission_date', 'LIKE', "%$search%")
                    ->orWhere('registration_number', 'LIKE', "%$search%")
                    ->orWhere('registration_date', 'LIKE', "%$search%")
                    ->orWhere('due_date', 'LIKE', "%$search%")
                    ->orWhere('cif_idr', 'LIKE', "%$search%")
                    ->orWhere('bm_bayar', 'LIKE', "%$search%")
                    ->orWhere('ppn_bayar', 'LIKE', "%$search%")
                    ->orWhere('pph_bayar', 'LIKE', "%$search%");
            });
        })->when($part_number, function ($query) use ($part_number) {
            $query->where('part_number', 'LIKE', "%$part_number%");
        })->when($description, function ($query) use ($description) {
            $query->where('description', 'LIKE', "%$description%");
        })->when($quantity, function ($query) use ($quantity) {
            $query->where('quantity', 'LIKE', "%$quantity%");
        })->when($unit_measure, function ($query) use ($unit_measure) {
            $query->where('unit_measure', 'LIKE', "%$unit_measure%");
        })->when($register_aircraft, function ($query) use ($register_aircraft) {
            $query->where('register_aircraft', 'LIKE', "%$register_aircraft%");
        })->when($customer, function ($query) use ($customer) {
            $query->where('customer', 'LIKE', "%$customer%");
        })->when($date_install, function ($query) use ($date_install) {
            $query->where('date_install', 'LIKE', "%$date_install%");
        })->when($date_aircraft_in, function ($query) use ($date_aircraft_in) {
            $query->where('date_aircraft_in', 'LIKE', "%$date_aircraft_in%");
        })->when($date_aircraft_out, function ($query) use ($date_aircraft_out) {
            $query->where('date_aircraft_out', 'LIKE', "%$date_aircraft_out%");
        })->when($document_type, function ($query) use ($document_type) {
            $query->where('document_type', 'LIKE', "%$document_type%");
        })->when($submission_number, function ($query) use ($submission_number) {
            $query->where('submission_number', 'LIKE', "%$submission_number%");
        })->when($submission_date, function ($query) use ($submission_date) {
            $query->where('submission_date', 'LIKE', "%$submission_date%");
        })->when($registration_number, function ($query) use ($registration_number) {
            $query->where('registration_number', 'LIKE', "%$registration_number%");
        })->when($registration_date, function ($query) use ($registration_date) {
            $query->where('registration_date', 'LIKE', "%$registration_date%");
        })->when($due_date, function ($query) use ($due_date) {
            $query->where('due_date', 'LIKE', "%$due_date%");
        })->when($cif_idr, function ($query) use ($cif_idr) {
            $query->where('cif_idr', 'LIKE', "%$cif_idr%");
        })->when($bm_bayar, function ($query) use ($bm_bayar) {
            $query->where('bm_bayar', 'LIKE', "%$bm_bayar%");
        })->when($ppn_bayar, function ($query) use ($ppn_bayar) {
            $query->where('ppn_bayar', 'LIKE', "%$ppn_bayar%");
        })->when($pph_bayar, function ($query) use ($pph_bayar) {
            $query->where('pph_bayar', 'LIKE', "%$pph_bayar%");
        })->when($filter_start_date, function ($query) use ($filter_start_date) {
            $query->whereDate('date_install', '>=', $filter_start_date);
        })->when($filter_end_date, function ($query) use ($filter_end_date) {
            $query->whereDate('date_install', '<=', $filter_end_date);
        })->when($filter_customer, function ($query) use ($filter_customer) {
            $query->where('customer', 'LIKE', "%$filter_customer%");
        })->when($filter_part_number, function ($query) use ($filter_part_number) {
            $query->where('part_number', 'LIKE', "%$filter_part_number%");
        })->when($filter_submission_number, function ($query) use ($filter_submission_number) {
            $query->where('submission_number', 'LIKE', "%$filter_submission_number%");
        })->when($filter_submission_date, function ($query) use ($filter_submission_date) {
            $query->where('submission_date', 'LIKE', "%$filter_submission_date%");
        })->when($filter_document_type, function ($query) use ($filter_document_type) {
            $query->where('document_type', 'LIKE', "%$filter_document_type%");
        })->when(($order && $by), function ($query) use ($order, $by) {
            $query->orderBy($order, $by);
        })->paginate($paginate);

        $result = [
            'search' => $search,
            'order' => $order,
            'by' => $by,
        ];

        $outbounds->appends($result);
        return $outbounds;
    }
}