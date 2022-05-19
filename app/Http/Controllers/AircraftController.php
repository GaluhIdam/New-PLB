<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aircraft;
// use Illuminate\Support\Facades\Response;

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
    public function storeDelivery(Request $request)
    {
        $request->validate([
            'operator' => 'required',
            'type' => 'required',
            'reg' => 'required|unique:aircraft,reg',
            'actual_time' => 'required',
        ]);

        $data = $request->all();
        $data['activity_type'] = 'delivery';

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
            'reg' => 'required|unique:aircraft,reg',
            'actual_time' => 'required',
        ]);

        $data = $request->all();
        $data['activity_type'] = 'redelivery';

        $redelivery = Aircraft::create($data);

        return response()->json(array(
            "response_code" => 201,
            "message" => "Delivery created successfully",
            "data" => $redelivery
        ), 201);
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
        $campus = Aircraft::find($id);
        $campus->delete();
    }
}
