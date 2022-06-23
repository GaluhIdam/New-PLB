<?php

namespace App\Http\Controllers;

use App\Models\MutationPeriodic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MutationPeriodicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $search_item_code =  $request->get('search_item_code');
        $search_item_name =  $request->get('search_item_name');
        $search_unit =  $request->get('search_unit');
        $search_beginning_balance =  $request->get('search_beginning_balance');
        $search_code_bc_16_in =  $request->get('search_code_bc_16_in');
        $search_code_bc_40_in =  $request->get('search_code_bc_40_in');
        $search_code_bc_27_in =  $request->get('search_code_bc_27_in');
        $search_code_bc_28_out =  $request->get('search_code_bc_28_out');
        $search_code_bc_41_out =  $request->get('search_code_bc_41_out');
        $search_code_bc_27_out =  $request->get('search_code_bc_27_out');
        $search_adjustment =  $request->get('search_adjustment');
        $search_book_balance =  $request->get('search_book_balance');
        $search_inventory_taking =  $request->get('search_inventory_taking');
        $search_difference =  $request->get('search_difference');
        $search_submission_date =  $request->get('search_submission_date');
        $search_submission_number =  $request->get('search_submission_number');

        if ($request->get('order') && $request->get('by')) {
            $order = $request->get('order');
            $by = $request->get('by');
        } else {
            $order = 'desc';
            $by = 'id';
        }

        if ($request->get('paginate')) {
            $paginate = $request->get('paginate');
        } else {
            $paginate = 10;
        }

        $mutation_periodics = MutationPeriodic::when($search, function ($query) use ($search) {
            return $query->where('item_code', 'like', '%' . $search . '%')
                ->orWhere('item_name', 'like', '%' . $search . '%')
                ->orWhere('unit', 'like', '%' . $search . '%')
                ->orWhere('beginning_balance', 'like', '%' . $search . '%')
                ->orWhere('code_bc_16_in', 'like', '%' . $search . '%')
                ->orWhere('code_bc_40_in', 'like', '%' . $search . '%')
                ->orWhere('code_bc_27_in', 'like', '%' . $search . '%')
                ->orWhere('code_bc_28_out', 'like', '%' . $search . '%')
                ->orWhere('code_bc_41_out', 'like', '%' . $search . '%')
                ->orWhere('code_bc_27_out', 'like', '%' . $search . '%')
                ->orWhere('adjustment', 'like', '%' . $search . '%')
                ->orWhere('book_balance', 'like', '%' . $search . '%')
                ->orWhere('inventory_taking', 'like', '%' . $search . '%')
                ->orWhere('difference', 'like', '%' . $search . '%')
                ->orWhere('submission_number', 'like', '%' . $search . '%')
                ->orWhere('submission_date', 'like', '%' . $search . '%');
        })->when(
            $search_item_code,
            function ($query) use ($search_item_code) {
                return $query->where('item_code', 'like', '%' . $search_item_code . '%');
            }
        )->when(
            $search_item_name,
            function ($query) use ($search_item_name) {
                return $query->where('item_name', 'like', '%' . $search_item_name . '%');
            }
        )->when(
            $search_unit,
            function ($query) use ($search_unit) {
                return $query->where('unit', 'like', '%' . $search_unit . '%');
            }
        )->when(
            $search_beginning_balance,
            function ($query) use ($search_beginning_balance) {
                return $query->where('beginning_balance', 'like', '%' . $search_beginning_balance . '%');
            }
        )->when(
            $search_code_bc_16_in,
            function ($query) use ($search_code_bc_16_in) {
                return $query->where('code_bc_16_in', 'like', '%' . $search_code_bc_16_in . '%');
            }
        )->when(
            $search_code_bc_40_in,
            function ($query) use ($search_code_bc_40_in) {
                return $query->where('code_bc_40_in', 'like', '%' . $search_code_bc_40_in . '%');
            }
        )->when(
            $search_code_bc_27_in,
            function ($query) use ($search_code_bc_27_in) {
                return $query->where('code_bc_27_in', 'like', '%' . $search_code_bc_27_in . '%');
            }
        )->when(
            $search_code_bc_28_out,
            function ($query) use ($search_code_bc_28_out) {
                return $query->where('code_bc_28_out', 'like', '%' . $search_code_bc_28_out . '%');
            }
        )->when(
            $search_code_bc_41_out,
            function ($query) use ($search_code_bc_41_out) {
                return $query->where('code_bc_41_out', 'like', '%' . $search_code_bc_41_out . '%');
            }
        )->when(
            $search_code_bc_27_out,
            function ($query) use ($search_code_bc_27_out) {
                return $query->where('code_bc_27_out', 'like', '%' . $search_code_bc_27_out . '%');
            }
        )->when(
            $search_adjustment,
            function ($query) use ($search_adjustment) {
                return $query->where('adjustment', 'like', '%' . $search_adjustment . '%');
            }
        )->when(
            $search_book_balance,
            function ($query) use ($search_book_balance) {
                return $query->where('book_balance', 'like', '%' . $search_book_balance . '%');
            }
        )->when(
            $search_inventory_taking,
            function ($query) use ($search_inventory_taking) {
                return $query->where('inventory_taking', 'like', '%' . $search_inventory_taking . '%');
            }
        )->when(
            $search_difference,
            function ($query) use ($search_difference) {
                return $query->where('difference', 'like', '%' . $search_difference . '%');
            }
        )->when(
            $search_submission_date,
            function ($query) use ($search_submission_date) {
                return $query->where('submission_date', 'like', '%' . $search_submission_date . '%');
            }
        )->when($search_submission_number, function ($query) use ($search_submission_number) {
            return $query->where('submission_number', 'like', '%' . $search_submission_number . '%');
        })
            ->paginate($paginate);

        $query_string = [
            'search' => $search,
            'order' => $order,
            'by' => $by,
        ];

        $mutation_periodics->appends($query_string);

        return $mutation_periodics;
    }

    public function searchDate(Request $request)

    {
        $formDate = $request->input('formDate');
        $toDate = $request->input('toDate');

        $query = DB::table('mutation_periodics')->select()
            ->where('submission_date', '>=', $formDate)
            ->where('submission_date', '<=', $toDate)
            ->get();

        return $query;
    }
}
