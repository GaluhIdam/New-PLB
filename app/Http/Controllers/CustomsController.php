<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomsInboundDocument;

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
                    $sub_query->where('part_number', 'LIKE', "%{$search}%")
                        ->orWhere('description', 'LIKE', "%{$search}%")
                        ->orWhere('quantity', 'LIKE', "%{$search}%")
                        ->orWhere('unit_code', 'LIKE', "%{$search}%")
                        ->orWhere('register', 'LIKE', "%{$search}%")
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

        $inbounds->appends($query_string);

        return $inbounds;
    }
}
