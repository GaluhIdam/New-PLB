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
        
        if ($request->get('order') && $request->get('by')) {
            $order = $request->get('order');
            $by = $request->get('by');
        } else {
            $order = 'id';
            $by = 'desc';
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
                        ->orWhere('item_name', 'LIKE', "%{$search}%");
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

        $inbounds->appends($query_string);

        return $inbounds;
    }

    public function outboundDocument(Request $request)
    {
        $search = $request->get('search');
        
        if ($request->get('order') && $request->get('by')) {
            $order = $request->get('order');
            $by = $request->get('by');
        } else {
            $order = 'id';
            $by = 'desc';
        }

        $inbounds = CustomsOutboundDocument::when($search, function ($query) use ($search) {
                $query->where(function ($sub_query) use ($search) {
                    $sub_query->where('document_type', 'LIKE', "%{$search}%")
                        ->orWhere('no_aju', 'LIKE', "%{$search}%")
                        ->orWhere('no_register', 'LIKE', "%{$search}%")
                        ->orWhere('owner', 'LIKE', "%{$search}%")
                        ->orWhere('item_code', 'LIKE', "%{$search}%")
                        ->orWhere('hs_code', 'LIKE', "%{$search}%")
                        ->orWhere('item_name', 'LIKE', "%{$search}%");
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

        $inbounds->appends($query_string);

        return $inbounds;
    }
}
