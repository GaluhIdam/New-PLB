<?php

namespace App\Http\Controllers;

use App\Models\MutationReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MutationReportController extends Controller
{
    use \App\Http\Traits\ActivityHistoryTrait;
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index(Request $request)
    {
        $this->recordActivity('Akses Report Mutasi');
        $search = $request->get('search');
        $search_item_code = $request->get('search_item_code');
        $search_item_name = $request->get('search_item_name');
        $search_unit = $request->get('search_unit');
        $search_beginning_balance = $request->get('search_beginning_balance');
        $search_code_bc_16_in = $request->get('search_code_bc_16_in');
        $search_code_bc_40_in = $request->get('search_code_bc_40_in');
        $search_code_bc_27_in = $request->get('search_code_bc_27_in');
        $search_code_bc_28_out = $request->get('search_code_bc_28_out');
        $search_code_bc_41_out = $request->get('search_code_bc_41_out');
        $search_code_bc_27_out = $request->get('search_code_bc_27_out');
        $search_book_balance = $request->get('search_book_balance'); //

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

        $mutation_reports = MutationReport::when($search, function ($query) use ($search) {
            $query->where(function ($sub_query) use ($search) {
                $sub_query->where('item_code', 'LIKE', "%{$search}%")
                    ->orWhere('item_name', 'LIKE', "%{$search}%")
                    ->orWhere('unit', 'LIKE', "%{$search}%")
                    ->orWhere('beginning_balance', 'LIKE', "%{$search}%")
                    ->orWhere('code_bc_16_in', 'LIKE', "%{$search}%")
                    ->orWhere('code_bc_40_in', 'LIKE', "%{$search}%")
                    ->orWhere('code_bc_27_in', 'LIKE', "%{$search}%")
                    ->orWhere('code_bc_28_out', 'LIKE', "%{$search}%")
                    ->orWhere('code_bc_41_out', 'LIKE', "%{$search}%")
                    ->orWhere('code_bc_27_out', 'LIKE', "%{$search}%")
                    ->orWhere('book_balance', 'LIKE', "%{$search}%");
            });
        })
            ->when($search_item_code, function ($query) use ($search_item_code) {
                $query->where('item_code', 'LIKE', "%{$search_item_code}%");
            })
            ->when($search_item_name, function ($query) use ($search_item_name) {
                $query->where('item_name', 'LIKE', "%{$search_item_name}%"); //
            })
            ->when($search_unit, function ($query) use ($search_unit) {
                $query->where('unit', 'LIKE', "%{$search_unit}%"); //
            })
            ->when($search_beginning_balance, function ($query) use ($search_beginning_balance) {
                $query->where('beginning_balance', 'LIKE', "%{$search_beginning_balance}%"); //
            })
            ->when($search_beginning_balance, function ($query) use ($search_beginning_balance) {
                $query->where('beginning_balance', 'LIKE', "%{$search_beginning_balance}%"); //
            })
            ->when($search_code_bc_16_in, function ($query) use ($search_code_bc_16_in) {
                $query->where('code_bc_16_in', 'LIKE', "%{$search_code_bc_16_in}%"); //
            })
            ->when($search_code_bc_40_in, function ($query) use ($search_code_bc_40_in) {
                $query->where('code_bc_40_in', 'LIKE', "%{$search_code_bc_40_in}%"); //
            })
            ->when($search_code_bc_27_in, function ($query) use ($search_code_bc_27_in) {
                $query->where('code_bc_27_in', 'LIKE', "%{$search_code_bc_27_in}%"); //
            })
            ->when($search_code_bc_28_out, function ($query) use ($search_code_bc_28_out) {
                $query->where('code_bc_28_out', 'LIKE', "%{$search_code_bc_28_out}%"); //
            })
            ->when($search_code_bc_41_out, function ($query) use ($search_code_bc_41_out) {
                $query->where('code_bc_41_out', 'LIKE', "%{$search_code_bc_41_out}%"); //
            })
            ->when($search_code_bc_27_out, function ($query) use ($search_code_bc_27_out) {
                $query->where('code_bc_27_out', 'LIKE', "%{$search_code_bc_27_out}%"); //
            })
            ->when($search_book_balance, function ($query) use ($search_book_balance) {
                $query->where('search_book_balance', 'LIKE', "%{$search_book_balance}%");
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

        $mutation_reports->appends($query_string);
        return $mutation_reports;
    }
}