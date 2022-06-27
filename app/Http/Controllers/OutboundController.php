<?php

namespace App\Http\Controllers;

use App\Models\Outbound;
use Illuminate\Http\Request;


class OutboundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function outbound1(Request $request)
    {
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
        $search = $request->get('search');
        $part_number = $request->get('part_number');
        $description = $request->get('description');
        $quantity = $request->get('quantity');
        $unit_code = $request->get('unit_code');
        $customer = $request->get('customer');

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
        })->when($customer, function ($query) use ($customer) {
            $query->where('customer', 'LIKE', "%{$customer}%");
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
        $search = $request->get('search');
        $part_number = $request->get('part_number');
        $description = $request->get('description');
        $quantity = $request->get('quantity');
        $unit_code = $request->get('unit_code');
        $register_ac = $request->get('register_ac');
        $customer = $request->get('customer');

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
}
