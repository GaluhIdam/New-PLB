<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomsInboundDocument;
use App\Models\CustomsOutboundDocument;

class CustomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inboundDocument(Request $request)
    {
        $search = $request->get('search');
        $search_document_type = $request->get('search_document_type');
        $search_no_aju = $request->get('search_no_aju');
        $search_date_aju = $request->get('search_date_aju');
        $search_no_register = $request->get('search_no_register');
        $search_date_register = $request->get('search_date_register');
        $search_date_inbound = $request->get('search_date_inbound');
        $search_sender = $request->get('search_sender');
        $search_owner = $request->get('search_owner');
        $search_item_code = $request->get('search_item_code');
        $search_hs_code = $request->get('search_hs_code');
        $search_item_name = $request->get('search_item_name');
        $search_quantity = $request->get('search_quantity');
        $search_unit = $request->get('search_unit');
        $search_item_value = $request->get('search_item_value');

        $filter_start_date = $request->get('filter_start_date');
        $filter_end_date = $request->get('filter_end_date');
        $filter_no_aju = $request->get('filter_no_aju');
        $filter_document_type = $request->get('filter_document_type');

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

        $inbounds = CustomsInboundDocument::when($search, function ($query) use ($search) {
            $query->where(function ($sub_query) use ($search) {
                $sub_query->where('document_type', 'LIKE', "%{$search}%")
                    ->orWhere('no_aju', 'LIKE', "%{$search}%")
                    ->orWhere('no_register', 'LIKE', "%{$search}%")
                    ->orWhere('sender', 'LIKE', "%{$search}%")
                    ->orWhere('owner', 'LIKE', "%{$search}%")
                    ->orWhere('item_code', 'LIKE', "%{$search}%")
                    ->orWhere('hs_code', 'LIKE', "%{$search}%")
                    ->orWhere('item_name', 'LIKE', "%{$search}%")
                    ->orWhere('quantity', 'LIKE', "%{$search}%")
                    ->orWhere('unit', 'LIKE', "%{$search}%")
                    ->orWhere('item_value', 'LIKE', "%{$search}%");
            });
        })
            ->when($search_document_type, function ($query) use ($search_document_type) {
                $query->where('document_type', 'LIKE', "%{$search_document_type}%");
            })
            ->when($search_no_aju, function ($query) use ($search_no_aju) {
                $query->where('no_aju', 'LIKE', "%{$search_no_aju}%");
            })
            ->when($search_date_aju, function ($query) use ($search_date_aju) {
                $query->whereDate('date_aju', $search_date_aju);
            })
            ->when($search_no_register, function ($query) use ($search_no_register) {
                $query->where('no_register', 'LIKE', "%{$search_no_register}%");
            })
            ->when($search_date_register, function ($query) use ($search_date_register) {
                $query->whereDate('date_register', $search_date_register);
            })
            ->when($search_date_inbound, function ($query) use ($search_date_inbound) {
                $query->whereDate('date_inbound', $search_date_inbound);
            })
            ->when($search_sender, function ($query) use ($search_sender) {
                $query->where('sender', 'LIKE', "%{$search_sender}%");
            })
            ->when($search_owner, function ($query) use ($search_owner) {
                $query->where('owner', 'LIKE', "%{$search_owner}%");
            })
            ->when($search_item_code, function ($query) use ($search_item_code) {
                $query->where('item_code', 'LIKE', "%{$search_item_code}%");
            })
            ->when($search_hs_code, function ($query) use ($search_hs_code) {
                $query->where('hs_code', 'LIKE', "%{$search_hs_code}%");
            })
            ->when($search_item_name, function ($query) use ($search_item_name) {
                $query->where('item_name', 'LIKE', "%{$search_item_name}%");
            })
            ->when($search_quantity, function ($query) use ($search_quantity) {
                $query->where('quantity', 'LIKE', "%{$search_quantity}%");
            })
            ->when($search_unit, function ($query) use ($search_unit) {
                $query->where('unit', 'LIKE', "%{$search_unit}%");
            })
            ->when($search_item_value, function ($query) use ($search_item_value) {
                $query->where('item_value', 'LIKE', "%{$search_item_value}%");
            })
            ->when(($order && $by), function ($query) use ($order, $by) {
                $query->orderBy($order, $by);
            })
            ->when($filter_start_date, function ($query) use ($filter_start_date) {
                $query->whereDate('date_aju', '>=', $filter_start_date);
            })
            ->when($filter_end_date, function ($query) use ($filter_end_date) {
                $query->whereDate('date_aju', '<=', $filter_end_date);
            })
            ->when($filter_no_aju, function ($query) use ($filter_no_aju) {
                $query->where('no_aju', 'LIKE', "%{$filter_no_aju}%");
            })
            ->when($filter_document_type, function ($query) use ($filter_document_type) {
                $query->whereIn('document_type', $filter_document_type);
            })
            ->paginate($paginate);

        $query_string = [
            'search' => $search,
            'order' => $order,
            'by' => $by,
        ];

        $inbounds->appends($query_string);

        return $inbounds;
    }

    public function outboundDocument(Request $request)
    {
        $search = $request->get('search');
        $search_document_type = $request->get('search_document_type');
        $search_no_aju = $request->get('search_no_aju');
        $search_date_aju = $request->get('search_date_aju');
        $search_no_register = $request->get('search_no_register');
        $search_date_register = $request->get('search_date_register');
        $search_date_outbound = $request->get('search_date_outbound');
        $search_owner = $request->get('search_owner');
        $search_item_code = $request->get('search_item_code');
        $search_hs_code = $request->get('search_hs_code');
        $search_item_name = $request->get('search_item_name');
        $search_quantity = $request->get('search_quantity');
        $search_unit = $request->get('search_unit');
        $search_item_value = $request->get('search_item_value');

        $filter_start_date = $request->get('filter_start_date');
        $filter_end_date = $request->get('filter_end_date');
        $filter_no_aju = $request->get('filter_no_aju');
        $filter_document_type = $request->get('filter_document_type');

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

        $outbounds = CustomsOutboundDocument::when($search, function ($query) use ($search) {
            $query->where(function ($sub_query) use ($search) {
                $sub_query->where('document_type', 'LIKE', "%{$search}%")
                    ->orWhere('no_aju', 'LIKE', "%{$search}%")
                    ->orWhere('no_register', 'LIKE', "%{$search}%")
                    ->orWhere('owner', 'LIKE', "%{$search}%")
                    ->orWhere('item_code', 'LIKE', "%{$search}%")
                    ->orWhere('hs_code', 'LIKE', "%{$search}%")
                    ->orWhere('item_name', 'LIKE', "%{$search}%")
                    ->orWhere('quantity', 'LIKE', "%{$search}%")
                    ->orWhere('unit', 'LIKE', "%{$search}%")
                    ->orWhere('item_value', 'LIKE', "%{$search}%");
            });
        })
            ->when($search_document_type, function ($query) use ($search_document_type) {
                $query->where('document_type', 'LIKE', "%{$search_document_type}%");
            })
            ->when($search_no_aju, function ($query) use ($search_no_aju) {
                $query->where('no_aju', 'LIKE', "%{$search_no_aju}%");
            })
            ->when($search_date_aju, function ($query) use ($search_date_aju) {
                $query->whereDate('date_aju', $search_date_aju);
            })
            ->when($search_no_register, function ($query) use ($search_no_register) {
                $query->where('no_register', 'LIKE', "%{$search_no_register}%");
            })
            ->when($search_date_register, function ($query) use ($search_date_register) {
                $query->whereDate('date_register', $search_date_register);
            })
            ->when($search_date_outbound, function ($query) use ($search_date_outbound) {
                $query->whereDate('date_outbound', $search_date_outbound);
            })
            ->when($search_owner, function ($query) use ($search_owner) {
                $query->where('owner', 'LIKE', "%{$search_owner}%");
            })
            ->when($search_item_code, function ($query) use ($search_item_code) {
                $query->where('item_code', 'LIKE', "%{$search_item_code}%");
            })
            ->when($search_hs_code, function ($query) use ($search_hs_code) {
                $query->where('hs_code', 'LIKE', "%{$search_hs_code}%");
            })
            ->when($search_item_name, function ($query) use ($search_item_name) {
                $query->where('item_name', 'LIKE', "%{$search_item_name}%");
            })
            ->when($search_quantity, function ($query) use ($search_quantity) {
                $query->where('quantity', 'LIKE', "%{$search_quantity}%");
            })
            ->when($search_unit, function ($query) use ($search_unit) {
                $query->where('unit', 'LIKE', "%{$search_unit}%");
            })
            ->when($search_item_value, function ($query) use ($search_item_value) {
                $query->where('item_value', 'LIKE', "%{$search_item_value}%");
            })
            ->when($filter_start_date, function ($query) use ($filter_start_date) {
                $query->whereDate('date_aju', '>=', $filter_start_date);
            })
            ->when($filter_end_date, function ($query) use ($filter_end_date) {
                $query->whereDate('date_aju', '<=', $filter_end_date);
            })
            ->when($filter_no_aju, function ($query) use ($filter_no_aju) {
                $query->where('no_aju', 'LIKE', "%{$filter_no_aju}%");
            })
            ->when($filter_document_type, function ($query) use ($filter_document_type) {
                $query->whereIn('document_type', $filter_document_type);
            })
            ->when(($order && $by), function ($query) use ($order, $by) {
                $query->orderBy($order, $by);
            })
            ->paginate($paginate);

        $query_string = [
            'search' => $search,
            'order' => $order,
            'by' => $by,
        ];
    }
}