<?php

namespace App\Http\Controllers;

use App\Models\MutationCalculation;
use Illuminate\Http\Request;

class MutationCalculationController extends Controller
{
    public function index(Request $request)
    {
        $mutation_date = $request->get('mutation_date');

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

        $mutation_calculation = MutationCalculation::when($mutation_date, function ($query) use ($mutation_date) {
            $query->where('date', $mutation_date);
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
