<?php

namespace App\Http\Controllers;

use App\Models\Outbound;
use Illuminate\Http\Request;


class OutboundController extends Controller
{
    use \App\Http\Traits\ActivityHistoryTrait;
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function outbound1(Request $request)
    {
        $this->recordActivity('Akses Outbound Transaction 1');
        $search = $request->get('search');

        $part_number = $request->get('part_number');
        $description = $request->get('description');
        $quantity = $request->get('quantity');
        $unit_code = $request->get('unit_code');
        $register_ac = $request->get('register_ac');
        $customer = $request->get('customer');
        $date_install = $request->get('date_install');
        $date_ac_in = $request->get('date_ac_in');
        $date_ac_out = $request->get('date_ac_out');
        $type_bc_out = $request->get('type_bc_out');
        $no_aju = $request->get('no_aju');
        $date_bc_out = $request->get('date_bc_out');
        $cif_idr = $request->get('cif_idr');
        $bm_paid = $request->get('bm_paid');
        $ppn_paid = $request->get('ppn_paid');
        $pph_paid = $request->get('pph_paid');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $form_customer = $request->input('form_customer');
        $form_part_number = $request->input('form_part_number');


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

        $outbounds = Outbound::when($search, function ($query) use ($search) {
            $query->where(function ($sub_query) use ($search) {
                $sub_query->where('part_number', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%")
                    ->orWhere('quantity', 'LIKE', "%{$search}%")
                    ->orWhere('unit_code', 'LIKE', "%{$search}%")
                    ->orWhere('register_ac', 'LIKE', "%{$search}%")
                    ->orWhere('customer', 'LIKE', "%{$search}%")
                    ->orWhere('date_install', 'LIKE', "%{$search}%")
                    ->orWhere('date_ac_in', 'LIKE', "%{$search}%")
                    ->orWhere('date_ac_out', 'LIKE', "%{$search}%")
                    ->orWhere('type_bc_out', 'LIKE', "%{$search}%")
                    ->orWhere('no_aju', 'LIKE', "%{$search}%")
                    ->orWhere('date_bc_out', 'LIKE', "%{$search}%")
                    ->orWhere('cif_idr', 'LIKE', "%{$search}%")
                    ->orWhere('bm_paid', 'LIKE', "%{$search}%")
                    ->orWhere('ppn_paid', 'LIKE', "%{$search}%")
                    ->orWhere('pph_paid', 'LIKE', "%{$search}%");
            });
        })->when($part_number, function ($query) use ($part_number) {
            $query->where('part_number', 'LIKE', "%{$part_number}%");
        })->when($description, function ($query) use ($description) {
            $query->where('description', 'LIKE', "%{$description}%");
        })->when($quantity, function ($query) use ($quantity) {
            $query->where('quantity', 'LIKE', "%{$quantity}%");
        })->when($unit_code, function ($query) use ($unit_code) {
            $query->where('unit_code', 'LIKE', "%{$unit_code}%");
        })->when($register_ac, function ($query) use ($register_ac) {
            $query->where('register_ac', 'LIKE', "%{$register_ac}%");
        })->when($customer, function ($query) use ($customer) {
            $query->where('customer', 'LIKE', "%{$customer}%");
        })->when($date_install, function ($query) use ($date_install) {
            $query->where('date_install', 'LIKE', "%{$date_install}%");
        })->when($date_ac_in, function ($query) use ($date_ac_in) {
            $query->where('date_ac_in', 'LIKE', "%{$date_ac_in}%");
        })->when($date_ac_out, function ($query) use ($date_ac_out) {
            $query->where('date_ac_out', 'LIKE', "%{$date_ac_out}%");
        })->when($type_bc_out, function ($query) use ($type_bc_out) {
            $query->where('type_bc_out', 'LIKE', "%{$type_bc_out}%");
        })->when($no_aju, function ($query) use ($no_aju) {
            $query->where('no_aju', 'LIKE', "%{$no_aju}%");
        })->when($date_bc_out, function ($query) use ($date_bc_out) {
            $query->where('date_bc_out', 'LIKE', "%{$date_bc_out}%");
        })->when($cif_idr, function ($query) use ($cif_idr) {
            $query->where('cif_idr', 'LIKE', "%{$cif_idr}%");
        })->when($bm_paid, function ($query) use ($bm_paid) {
            $query->where('bm_paid', 'LIKE', "%{$bm_paid}%");
        })->when($ppn_paid, function ($query) use ($ppn_paid) {
            $query->where('ppn_paid', 'LIKE', "%{$ppn_paid}%");
        })->when($pph_paid, function ($query) use ($pph_paid) {
            $query->where('pph_paid', 'LIKE', "%{$pph_paid}%");
        })->when($start_date && $end_date,  function ($query) use ($start_date, $end_date) {
            $query->whereBetween('date_install', [$start_date, $end_date]);
        })->when($start_date,  function ($query) use ($start_date) {
            $query->whereDate('date_install', '>=', $start_date);
        })->when($end_date,  function ($query) use ($end_date) {
            $query->whereDate('date_install', '<=', $end_date);
        })->when(($order && $by), function ($query) use ($order, $by) {
            $query->orderBy($order, $by);
        })->paginate($paginate);

        $query_string = [
            'search' => $search,
            'order' => $order,
            'by' => $by,
        ];

        $outbounds->appends($query_string);

        return $outbounds;
    }
    public function outbound2(Request $request)
    {
        $this->recordActivity('Akses Outbound Transaction 2');

        $search = $request->get('search');
        $part_number = $request->get('part_number');
        $description = $request->get('description');
        $quantity = $request->get('quantity');
        $unit_code = $request->get('unit_code');
        $register_ac = $request->get('register_ac');
        $customer = $request->get('customer');
        $date_install = $request->get('date_install');
        $date_ac_in = $request->get('date_ac_in');
        $date_ac_out = $request->get('date_ac_out');
        $type_bc_out = $request->get('type_bc_out');
        $no_aju = $request->get('no_aju');
        $date_bc_out = $request->get('date_bc_out');
        $cif_idr = $request->get('cif_idr');
        $bm_paid = $request->get('bm_paid');
        $ppn_paid = $request->get('ppn_paid');
        $pph_paid = $request->get('pph_paid');
        //FIlter
        $filter_no_aju = $request->get('filter_no_aju');
        $filter_customer = $request->get('filter_customer');

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

        $outbounds = Outbound::when($search, function ($query) use ($search) {
            $query->where(function ($sub_query) use ($search) {
                $sub_query->where('part_number', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%")
                    ->orWhere('quantity', 'LIKE', "%{$search}%")
                    ->orWhere('unit_code', 'LIKE', "%{$search}%")
                    ->orWhere('register_ac', 'LIKE', "%{$search}%")
                    ->orWhere('customer', 'LIKE', "%{$search}%")
                    ->orWhere('date_install', 'LIKE', "%{$search}%")
                    ->orWhere('date_ac_in', 'LIKE', "%{$search}%")
                    ->orWhere('date_ac_out', 'LIKE', "%{$search}%")
                    ->orWhere('type_bc_out', 'LIKE', "%{$search}%")
                    ->orWhere('no_aju', 'LIKE', "%{$search}%")
                    ->orWhere('date_bc_out', 'LIKE', "%{$search}%")
                    ->orWhere('cif_idr', 'LIKE', "%{$search}%")
                    ->orWhere('bm_paid', 'LIKE', "%{$search}%")
                    ->orWhere('ppn_paid', 'LIKE', "%{$search}%")
                    ->orWhere('pph_paid', 'LIKE', "%{$search}%");
            });
        })->when($part_number, function ($query) use ($part_number) {
            $query->where('part_number', 'LIKE', "%{$part_number}%");
        })->when($description, function ($query) use ($description) {
            $query->where('description', 'LIKE', "%{$description}%");
        })->when($quantity, function ($query) use ($quantity) {
            $query->where('quantity', 'LIKE', "%{$quantity}%");
        })->when($unit_code, function ($query) use ($unit_code) {
            $query->where('unit_code', 'LIKE', "%{$unit_code}%");
        })->when($register_ac, function ($query) use ($register_ac) {
            $query->where('register_ac', 'LIKE', "%{$register_ac}%");
        })->when($customer, function ($query) use ($customer) {
            $query->where('customer', 'LIKE', "%{$customer}%");
        })->when($date_install, function ($query) use ($date_install) {
            $query->where('date_install', 'LIKE', "%{$date_install}%");
        })->when($date_ac_in, function ($query) use ($date_ac_in) {
            $query->where('date_ac_in', 'LIKE', "%{$date_ac_in}%");
        })->when($date_ac_out, function ($query) use ($date_ac_out) {
            $query->where('date_ac_out', 'LIKE', "%{$date_ac_out}%");
        })->when($type_bc_out, function ($query) use ($type_bc_out) {
            $query->where('type_bc_out', 'LIKE', "%{$type_bc_out}%");
        })->when($no_aju, function ($query) use ($no_aju) {
            $query->where('no_aju', 'LIKE', "%{$no_aju}%");
        })->when($date_bc_out, function ($query) use ($date_bc_out) {
            $query->where('date_bc_out', 'LIKE', "%{$date_bc_out}%");
        })->when($cif_idr, function ($query) use ($cif_idr) {
            $query->where('cif_idr', 'LIKE', "%{$cif_idr}%");
        })->when($bm_paid, function ($query) use ($bm_paid) {
            $query->where('bm_paid', 'LIKE', "%{$bm_paid}%");
        })->when($ppn_paid, function ($query) use ($ppn_paid) {
            $query->where('ppn_paid', 'LIKE', "%{$ppn_paid}%");
        })->when($pph_paid, function ($query) use ($pph_paid) {
            $query->where('pph_paid', 'LIKE', "%{$pph_paid}%");
        })->when($filter_customer, function ($query) use ($filter_customer) {
            $query->where('customer', 'LIKE', "%{$filter_customer}%");
        })->when($filter_no_aju, function ($query) use ($filter_no_aju) {
            $query->where('no_aju', 'LIKE', "%{$filter_no_aju}%");
        })->when(($order && $by), function ($query) use ($order, $by) {
            $query->orderBy($order, $by);
        })->paginate($paginate);

        $query_string = [
            'search' => $search,
            'order' => $order,
            'by' => $by,
        ];

        $outbounds->appends($query_string);

        return $outbounds;
    }

    public function outbound3(Request $request)
    {
        $this->recordActivity('Akses Outbound Transaction 3');

        $search = $request->get('search');
        $part_number = $request->get('part_number');
        $description = $request->get('description');
        $quantity = $request->get('quantity');
        $unit_code = $request->get('unit_code');
        $register_ac = $request->get('register_ac');
        $customer = $request->get('customer');
        $date_install = $request->get('date_install');
        $date_ac_in = $request->get('date_ac_in');
        $date_ac_out = $request->get('date_ac_out');
        $type_bc_out = $request->get('type_bc_out');
        $no_aju = $request->get('no_aju');
        $no_register = $request->get('no_register');
        $cif_idr = $request->get('cif_idr');
        $date_bc_out = $request->get('date_bc_out');
        $bm_paid = $request->get('bm_paid');
        $ppn_paid = $request->get('ppn_paid');
        $pph_paid = $request->get('pph_paid');

        $filter_no_register = $request->get('no_register');
        $filter_no_aju = $request->get('filter_no_aju');
        $filter_customer = $request->get('filter_customer');

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

        $outbounds = Outbound::when($search, function ($query) use ($search) {
            $query->where(function ($sub_query) use ($search) {
                $sub_query->where('part_number', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%")
                    ->orWhere('quantity', 'LIKE', "%{$search}%")
                    ->orWhere('unit_code', 'LIKE', "%{$search}%")
                    ->orWhere('register_ac', 'LIKE', "%{$search}%")
                    ->orWhere('customer', 'LIKE', "%{$search}%")
                    ->orWhere('date_install', 'LIKE', "%{$search}%")
                    ->orWhere('date_ac_in', 'LIKE', "%{$search}%")
                    ->orWhere('date_ac_out', 'LIKE', "%{$search}%")
                    ->orWhere('type_bc_out', 'LIKE', "%{$search}%")
                    ->orWhere('no_aju', 'LIKE', "%{$search}%")
                    ->orWhere('no_register', 'LIKE', "%{$search}%")
                    ->orWhere('cif_idr', 'LIKE', "%{$search}%")
                    ->orWhere('date_bc_out', 'LIKE', "%{$search}%")
                    ->orWhere('bm_paid', 'LIKE', "%{$search}%")
                    ->orWhere('ppn_paid', 'LIKE', "%{$search}%")
                    ->orWhere('pph_paid', 'LIKE', "%{$search}%");
            });
        })->when($part_number, function ($query) use ($part_number) {
            $query->where('part_number', 'LIKE', "%{$part_number}%");
        })->when($description, function ($query) use ($description) {
            $query->where('description', 'LIKE', "%{$description}%");
        })->when($quantity, function ($query) use ($quantity) {
            $query->where('quantity', 'LIKE', "%{$quantity}%");
        })->when($unit_code, function ($query) use ($unit_code) {
            $query->where('unit_code', 'LIKE', "%{$unit_code}%");
        })->when($register_ac, function ($query) use ($register_ac) {
            $query->where('register_ac', 'LIKE', "%{$register_ac}%");
        })->when($customer, function ($query) use ($customer) {
            $query->where('customer', 'LIKE', "%{$customer}%");
        })->when($date_install, function ($query) use ($date_install) {
            $query->where('date_install', 'LIKE', "%{$date_install}%");
        })->when($date_ac_in, function ($query) use ($date_ac_in) {
            $query->where('date_ac_in', 'LIKE', "%{$date_ac_in}%");
        })->when($date_ac_out, function ($query) use ($date_ac_out) {
            $query->where('date_ac_out', 'LIKE', "%{$date_ac_out}%");
        })->when($type_bc_out, function ($query) use ($type_bc_out) {
            $query->where('type_bc_out', 'LIKE', "%{$type_bc_out}%");
        })->when($no_aju, function ($query) use ($no_aju) {
            $query->where('no_aju', 'LIKE', "%{$no_aju}%");
        })->when($no_register, function ($query) use ($no_register) {
            $query->where('no_register', 'LIKE', "%{$no_register}%");
        })->when($cif_idr, function ($query) use ($cif_idr) {
            $query->where('cif_idr', 'LIKE', "%{$cif_idr}%");
        })->when($date_bc_out, function ($query) use ($date_bc_out) {
            $query->where('date_bc_out', 'LIKE', "%{$date_bc_out}%");
        })->when($bm_paid, function ($query) use ($bm_paid) {
            $query->where('bm_paid', 'LIKE', "%{$bm_paid}%");
        })->when($ppn_paid, function ($query) use ($ppn_paid) {
            $query->where('ppn_paid', 'LIKE', "%{$ppn_paid}%");
        })->when($pph_paid, function ($query) use ($pph_paid) {
            $query->where('pph_paid', 'LIKE', "%{$pph_paid}%");
        })->when($filter_no_register, function ($query) use ($filter_no_register) {
            $query->where('no_register', 'LIKE', "%{$filter_no_register}%");
        })->when($filter_no_aju, function ($query) use ($filter_no_aju) {
            $query->where('no_aju', 'LIKE', "%{$filter_no_aju}%");
        })->when($filter_customer, function ($query) use ($filter_customer) {
            $query->where('customer', 'LIKE', "%{$filter_customer}%");
        })->when(($order && $by), function ($query) use ($order, $by) {
            $query->orderBy($order, $by);
        })->paginate($paginate);

        $query_string = [
            'search' => $search,
            'order' => $order,
            'by' => $by,
        ];

        $outbounds->appends($query_string);

        return $outbounds;
    }

    public function summary(Request $request)
    {
        $this->recordActivity('Akses Summary Outbound');
        $search = $request->get('search');
        $part_number = $request->get('part_number');
        $description = $request->get('description');
        $quantity = $request->get('quantity');
        $unit_code = $request->get('unit_code');
        $register_ac = $request->get('register_ac');
        $customer = $request->get('customer');

        $filter_part_number = $request->get('filter_part_number');

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

        $outbounds = Outbound::when($search, function ($query) use ($search) {
            $query->where(function ($sub_query) use ($search) {
                $sub_query->where('part_number', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%")
                    ->orWhere('quantity', 'LIKE', "%{$search}%")
                    ->orWhere('unit_code', 'LIKE', "%{$search}%")
                    ->orWhere('register_ac', 'LIKE', "%{$search}%")
                    ->orWhere('customer', 'LIKE', "%{$search}%");
            });
        })->when($part_number, function ($query) use ($part_number) {
            $query->where('part_number', 'LIKE', "%{$part_number}%");
        })->when($description, function ($query) use ($description) {
            $query->where('description', 'LIKE', "%{$description}%");
        })->when($quantity, function ($query) use ($quantity) {
            $query->where('quantity', 'LIKE', "%{$quantity}%");
        })->when($unit_code, function ($query) use ($unit_code) {
            $query->where('unit_code', 'LIKE', "%{$unit_code}%");
        })->when($register_ac, function ($query) use ($register_ac) {
            $query->where('register_ac', 'LIKE', "%{$register_ac}%");
        })->when($customer, function ($query) use ($customer) {
            $query->where('customer', 'LIKE', "%{$customer}%");
        })->when($filter_part_number, function ($query) use ($filter_part_number) {
            $query->where('part_number', 'LIKE', "%{$filter_part_number}%");
        })->when(($order && $by), function ($query) use ($order, $by) {
            $query->orderBy($order, $by);
        })->paginate($paginate);

        $query_string = [
            'search' => $search,
            'order' => $order,
            'by' => $by,
        ];


        $outbounds->appends($query_string);

        return $outbounds;
    }


    public function getOutbound1(Request $request)
    {
        // Query untuk Sortir Data
        $search = $request->get('search'); // Untuk Pencarian
        $part_number = $request->get('part_number'); // Untuk Pencarian Part Number
        $description = $request->get('description'); // Untuk Pencarian Description
        $quantity = $request->get('search_quantity'); // Untuk Pencarian Quantity
        $unit_measure = $request->get('unit_measure'); // Untuk Pencarian Kode Satuan
        $register_aircraft = $request->get('register_aircraft'); // Untuk Pencarian Register Aircraft
        $customer = $request->get('customer'); // Untuk Pencarian customer
        $date_install = $request->get('date_install'); // Untuk Pencarian Install Date
        $date_aircraft_in = $request->get('date_aircraft_in'); // Untuk Pencarian Aircraft In Date
        $date_aircraft_out = $request->get('date_aircraft_out'); // Untuk Pencarian Aircraft Out Date
        $document_type = $request->get('document_type'); // Untuk Pencarian Type BC
        $submission_number = $request->get('submission_number'); // Untuk Pencarian Nomor Aju
        $submission_date = $request->get('submission_date'); // Untuk Pencarian Tanggal Aju
        $registration_number = $request->get('registration_number'); // Untuk Pencarian Nomor Daftar
        $registration_date = $request->get('registration_date'); // Untuk Pencarian Tanggal Daftar
        $cif_idr = $request->get('cif_idr'); // Untuk Pencarian CIF IDR
        $bm_bayar = $request->get('bm_bayar'); // Untuk Pencarian BM Bayar
        $ppn_bayar = $request->get('ppn_bayar'); // Untuk Pencarian PPn Bayar
        $pph_bayar = $request->get('pph_bayar'); // Untuk Pencarian PPh Bayar

        // Filter Data
        $filter_start_date = $request->get('filter_start_date'); // Untuk Filter Tanggal Start Date
        $filter_end_date = $request->get('filter_end_date'); // Untuk Filter Tanggal End Date
        $filter_customer = $request->get('filter_customer'); // Untuk Filter customer
        $filter_part_number = $request->get('filter_part_number'); // Untuk Filter Part Number
        $filter_document_type = $request->get('filter_document_type'); // Untuk Filter Type BC

        // Sort Data
        if ($request->get('order') && $request->get('by')) {
            $order = $request->get('order');
            $by = $request->get('by');
        } else {
            $order = 'order_type';
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
                    ->orWhere('description', 'LIKE', "%{$search}%")
                    ->orWhere('quantity', 'LIKE', "%$search%")
                    ->orWhere('unit_measure', 'LIKE', "%$search%")
                    ->orWhere('register_aircraft', 'LIKE', "%$search%")
                    ->orWhere('date_install', 'LIKE', "%$search%")
                    ->orWhere('date_aircraft_in', 'LIKE', "%$search%")
                    ->orWhere('date_aircraft_out', 'LIKE', "%$search%")
                    ->orWhere('document_type', 'LIKE', "%$search%")
                    ->orWhere('submission_number', 'LIKE', "%$search%")
                    ->orWhere('submission_date', 'LIKE', "%$search%")
                    ->orWhere('registration_number', 'LIKE', "%$search%")
                    ->orWhere('registration_date', 'LIKE', "%$search%")
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
        })->when($cif_idr, function ($query) use ($cif_idr) {
            $query->where('cif_idr', 'LIKE', "%$cif_idr%");
        })->when($bm_bayar, function ($query) use ($bm_bayar) {
            $query->where('bm_bayar', 'LIKE', "%$bm_bayar%");
        })->when($ppn_bayar, function ($query) use ($ppn_bayar) {
            $query->where('ppn_bayar', 'LIKE', "%$ppn_bayar%");
        })->when($pph_bayar, function ($query) use ($pph_bayar) {
            $query->where('pph_bayar', 'LIKE', "%$pph_bayar%");
        })->when($filter_start_date && $filter_end_date, function ($query) use ($filter_start_date, $filter_end_date) {
            $query->whereBetween('date_install', [$filter_start_date, $filter_end_date]);
        })->when($filter_start_date, function ($query) use ($filter_start_date) {
            $query->where('date_install', '>=', $filter_start_date);
        })->when($filter_end_date, function ($query) use ($filter_end_date) {
            $query->where('date_install', '<=', $filter_end_date);
        })->when($filter_customer, function ($query) use ($filter_customer) {
            $query->where('customer', 'LIKE', "%$filter_customer%");
        })->when($filter_part_number, function ($query) use ($filter_part_number) {
            $query->where('part_number', 'LIKE', "%$filter_part_number%");
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