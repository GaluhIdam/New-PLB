<?php

namespace App\Http\Controllers;

use App\Models\MutationPeriodic;
use Illuminate\Http\Request;

class MutationPeriodicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->input('showdata')) {
            return MutationPeriodic::orderBy('created_at', 'desc')->get();
        }
        $columns = ['item_code', 'item_name', 'unit', 'beginning_balance', 'in_bc_16', 'in_bc_40', 'in_bc_27', 'out_bc_28', 'out_bc_41', 'out_bc_27', 'adjustment', 'book_balance', 'inventory_taking', 'difference', 'created_at'];
        $length = $request->input('length');
        $column = $request->input('column', 0);
        $search_input = $request->input('search');
        $query = MutationPeriodic::select('item_code', 'item_name', 'unit', 'beginning_balance', 'in_bc_16', 'in_bc_40', 'in_bc_27', 'out_bc_28', 'out_bc_41', 'out_bc_27', 'adjustment', 'book_balance', 'inventory_taking', 'difference', 'created_at')->orderBy($columns[$column]);
        if ($search_input) {
            $query->where(function ($query) use ($search_input) {
                $query->where('item_code', 'like', '%' . $search_input . '%')
                    ->orWhere('item_name', 'like', '%' . $search_input . '%')
                    ->orWhere('unit', 'like', '%' . $search_input . '%')
                    ->orWhere('beginning_balance', 'like', '%' . $search_input . '%')
                    ->orWhere('in_bc_16', 'like', '%' . $search_input . '%')
                    ->orWhere('in_bc_40', 'like', '%' . $search_input . '%')
                    ->orWhere('in_bc_27', 'like', '%' . $search_input . '%')
                    ->orWhere('out_bc_28', 'like', '%' . $search_input . '%')
                    ->orWhere('out_bc_41', 'like', '%' . $search_input . '%')
                    ->orWhere('out_bc_27', 'like', '%' . $search_input . '%')
                    ->orWhere('adjustment', 'like', '%' . $search_input . '%')
                    ->orWhere('book_balance', 'like', '%' . $search_input . '%')
                    ->orWhere('inventory_taking', 'like', '%' . $search_input . '%')
                    ->orWhere('difference', 'like', '%' . $search_input . '%')
                    ->orWhere('created_at', 'like', '%' . $search_input . '%');
            });
        }
        $MutationPeriodic = $query->paginate($length);
        return ['data' => $MutationPeriodic];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $MutationPeriodic = MutationPeriodic::findOrFail($id);
        $MutationPeriodic->delete();
        return ['message' => 'Mutation Periodic Deleted'];
    }
}
