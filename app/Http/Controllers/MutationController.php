<?php

namespace App\Http\Controllers;

use App\Models\Mutation;
use Illuminate\Http\Request;

class MutationController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        if ($request->get('order') && $request->get('by')) {
            $order = $request->get('order');
            $by = $request->get('by');
        } else {
            $order = 'id';
            $by = 'desc';
        }

        $mutations = Mutation::when($search, function ($query) use ($search) {
            $query->where(function ($sub_query) use ($search) {
                $sub_query->where('item_code', 'LIKE', "%{$search}%")
                    ->orWhere('item_name', 'LIKE', "%{$search}%")
                    ->orWhere('unit', 'LIKE', "%{$search}%")
                    ->orWhere('beginning_balance', 'LIKE', "%{$search}%")
                    ->orWhere('in_bc_16', 'LIKE', "%{$search}%")
                    ->orWhere('in_bc_40', 'LIKE', "%{$search}%")
                    ->orWhere('in_bc_27', 'LIKE', "%{$search}%")
                    ->orWhere('out_bc_28', 'LIKE', "%{$search}%")
                    ->orWhere('out_bc_41', 'LIKE', "%{$search}%")
                    ->orWhere('out_bc_27', 'LIKE', "%{$search}%")
                    ->orWhere('adjustment', 'LIKE', "%{$search}%")
                    ->orWhere('book_balance', 'LIKE', "%{$search}%")
                    ->orWhere('inventory_taking', 'LIKE', "%{$search}%")
                    ->orWhere('difference', 'LIKE', "%{$search}%");
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

        $mutations->appends($query_string);
        return $mutations;
    }
}
