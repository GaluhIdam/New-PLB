<?php

namespace App\Http\Controllers;

use App\Models\MutationCalculation;
use Illuminate\Http\Request;

class MutationCalculationController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $search_date = $request->get('search_date');

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

        $mutation_calculation = MutationCalculation::when($search, function ($query) use ($search) {
            $query->where(function ($sub_query) use ($search) {
                $sub_query->where('item_code', 'LIKE', "%{$search}%")
                    ->orWhere('item_name', 'LIKE', "%{$search}%")
                    ->orWhere('unit', 'LIKE', "%{$search}%")
                    ->orWhere('first_balance', 'LIKE', "%{$search}%")
                    ->orWhere('income_bc16', 'LIKE', "%{$search}%")
                    ->orWhere('income_bc40', 'LIKE', "%{$search}%")
                    ->orWhere('income_bc27', 'LIKE', "%{$search}%")
                    ->orWhere('cost_bc28', 'LIKE', "%{$search}%")
                    ->orWhere('cost_bc41', 'LIKE', "%{$search}%")
                    ->orWhere('cost_bc27', 'LIKE', "%{$search}%")
                    ->orWhere('cost_bc30', 'LIKE', "%{$search}%")
                    ->orWhere('adjustment', 'LIKE', "%{$search}%")
                    ->orWhere('book_balance', 'LIKE', "%{$search}%")
                    ->orWhere('stock_opname', 'LIKE', "%{$search}%")
                    ->orWhere('difference', 'LIKE', "%{$search}%");
            });
        })->when($search_date, function ($query) use ($search_date) {
            $query->where('date', 'LIKE', "%{$search_date}%");
        })->when(($order && $by), function ($query) use ($order, $by) {
            $query->orderBy($order, $by);
        })->paginate($paginate);

        $query_string = [
            'order' => $order,
            'by' => $by,
        ];

        $mutation_calculation->appends($query_string);

        return $mutation_calculation;
    }
}
