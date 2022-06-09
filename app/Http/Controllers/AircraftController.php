<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aircraft;

class AircraftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');

        if ($request->get('order') && $request->get('by')) {
            $order = $request->get('order');
            $by = $request->get('by');
        } else {
            $order = 'id';
            $by = 'desc';
        }

        $mutations = Aircraft::when($search, function ($query) use ($search) {
                $query->where(function ($sub_query) use ($search) {
                    $sub_query->where('operator', 'LIKE', "%{$search}%")
                        ->orWhere('reg', 'LIKE', "%{$search}%")
                        ->orWhere('operator', 'LIKE', "%{$search}%")
                        ->orWhere('type', 'LIKE', "%{$search}%");
                });
            })
            ->when($start_date, function ($query) use ($start_date) {
                $query->whereDate('actual_time', '>=', $start_date);
            })
            ->when($end_date, function ($query) use ($end_date) {
                $query->whereDate('actual_time', '<=', $end_date);
            })
            ->when(($order && $by), function ($query) use ($order, $by) {
                $query->orderBy($order, $by);
            })
            ->paginate(10);

        $query_string = [
            'search' => $search,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'order' => $order,
            'by' => $by,
        ];

        $mutations->appends($query_string);

        return $mutations;
    }

    public function data(Request $request)
    {
        $search = $request->get('search');

        $mutations = Aircraft::when($search, function ($query) use ($search) {
                                $query->where(function ($sub_query) use ($search) {
                                    $sub_query->where('reg', 'LIKE', "%{$search}%");
                                });
                            })
                            ->where('date_out', null)
                            ->get();

        return $mutations;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeDelivery(Request $request)
    {
        $request->validate([
            'operator' => 'required',
            'type' => 'required',
            'reg' => 'required|unique:aircraft',
            'date_in' => 'required',
        ],[
            'reg.required' => 'Registration field is required.',
            'reg.unique' => 'The registration has already been taken.',
            'date_in.required' => 'Actual time arrival field is required.',
        ]);

        $data = $request->all();

        if ($request->hasFile('rksp')) {
            $path = $request->file('rksp')->store('uploaded_documents', 'public');
            $data['rksp'] = $path;
        }
        
        $delivery = Aircraft::create($data);

        return response()->json(array(
            "response_code" => 201,
            "message" => "Delivery created successfully",
            "data" => $delivery
        ), 201);
    }

    public function storeRedelivery(Request $request)
    {
        $request->validate([
            'operator' => 'required',
            'type' => 'required',
            'reg' => 'required',
            'date_out' => 'required',
        ],[
            'reg.required' => 'Registration field is required.',
            'date_out.required' => 'Actual time depart field is required.',
        ]);

        if ($redelivery = Aircraft::where('reg', $request->reg)->first()) {
            $redelivery->date_out = $request->date_out;
            $redelivery->save();
            
            return response()->json(array(
                "response_code" => 201,
                "message" => "Delivery created successfully",
                "data" => $redelivery
            ), 201);
        } else {
            return response()->json(array(
                "response_code" => 500,
                "message" => "Error occurred",
            ), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $campus = Aircraft::find($id);
        $campus->delete();
    }
}
