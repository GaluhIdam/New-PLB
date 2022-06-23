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
        if ($request->get('order') && $request->get('by')) {
            $order = $request->get('order');
            $by = $request->get('by');
        } else {
            $order = 'id';
            $by = 'desc';
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
        })
            ->when(($order && $by), function ($query) use ($order, $by) {
                $query->orderBy($order, $by);
            })
            ->paginate(10);

        $query_string = [
            'search' => $search,
            'order' => $order,
            'by' => $by,
        ];

        $outbounds->appends($query_string);

        return $outbounds;
    }
<<<<<<< HEAD
=======

>>>>>>> dev
    public function outbound2(Request $request)
    {
        $search = $request->get('search');
        if ($request->get('order') && $request->get('by')) {
            $order = $request->get('order');
            $by = $request->get('by');
        } else {
            $order = 'id';
            $by = 'desc';
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
        })
            ->when(($order && $by), function ($query) use ($order, $by) {
                $query->orderBy($order, $by);
            })
            ->paginate(10);

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
        if ($request->get('order') && $request->get('by')) {
            $order = $request->get('order');
            $by = $request->get('by');
        } else {
            $order = 'id';
            $by = 'desc';
        }

        $outbounds = Outbound::when($search, function ($query) use ($search) {
            $query->where(function ($sub_query) use ($search) {
                $sub_query->where('part_number', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%")
                    ->orWhere('quantity', 'LIKE', "%{$search}%")
                    ->orWhere('unit_code', 'LIKE', "%{$search}%")
                    ->orWhere('register_ac', 'LIKE', "%{$search}%")
<<<<<<< HEAD
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
=======
                    ->orWhere('customer', 'LIKE', "%{$search}%");
>>>>>>> dev
            });
        })
            ->when(($order && $by), function ($query) use ($order, $by) {
                $query->orderBy($order, $by);
            })
            ->paginate(10);

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
        if ($request->get('order') && $request->get('by')) {
            $order = $request->get('order');
            $by = $request->get('by');
        } else {
            $order = 'id';
            $by = 'desc';
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
        })
            ->when(($order && $by), function ($query) use ($order, $by) {
                $query->orderBy($order, $by);
            })
            ->paginate(10);

        $query_string = [
            'search' => $search,
            'order' => $order,
            'by' => $by,
        ];
    }
}
