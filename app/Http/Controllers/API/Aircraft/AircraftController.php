<?php

namespace App\Http\Controllers\API\Aircraft;

use App\Http\Controllers\Controller;
use App\Models\Aircraft;
use Illuminate\Http\Request;

class AircraftController extends Controller
{

    //    'AIRCRAFT_REGISTRATION',
    //     'AIRCRAFT_TYPE',
    //     'OPERATOR',
    //     'DATE_AIRCRAFT_IN',
    //     'DATE_AIRCRAFT_OUT',
    //     'RKSP',
    //     'FLIGHT_ROUTE',
    //     'CREWS',
    //     'REPORT',
    //     'ID_HEADER',
    //     'ID_BARANG'
    public function index(Request $request)
    {
        // Record Activity
        $this->recordActivity('Akses Aircraft Mutation');

        // Search by keyword
        $search = $request->get('search');
        $search_aircraft_registration = $request->get('search_aircraft_registration');
        $search_aircraft_type = $request->get('search_aircraft_type');
        $search_operator = $request->get('search_operator');
        $search_date_aircraft_in = $request->get('search_date_aircraft_in');
        $search_date_aircraft_out = $request->get('search_date_aircraft_out');
        $search_rksp = $request->get('search_rksp');
        $search_flight_route = $request->get('search_flight_route');
        $search_crews = $request->get('search_crews');
        $search_report = $request->get('search_report');

        // Sort Data
        if ($request->get('order') && $request->get('by')) {
            $order = $request->get('order');
            $by = $request->get('by');
        } else {
            $order = 'ID';
            $by = 'desc';
        }

        // Paginate
        if ($request->get('paginate')) {
            $paginate = $request->get('paginate');
        } else {
            $paginate = 10;
        }

        $aircraft = Aircraft::when($search, function ($query) use ($search) {
            $query->where(function ($sub_query) use ($search) {
                $sub_query->where('AIRCRAFT_REGISTRATION', 'LIKE', "%{$search}%")
                    ->orWhere('AIRCRAFT_TYPE', 'LIKE', "%{$search}%")
                    ->orWhere('OPERATOR', 'LIKE', "%{$search}%")
                    ->orWhere('DATE_AIRCRAFT_IN', 'LIKE', "%{$search}%")
                    ->orWhere('DATE_AIRCRAFT_OUT', 'LIKE', "%{$search}%")
                    ->orWhere('RKSP', 'LIKE', "%{$search}%")
                    ->orWhere('FLIGHT_ROUTE', 'LIKE', "%{$search}%")
                    ->orWhere('CREWS', 'LIKE', "%{$search}%")
                    ->orWhere('REPORT', 'LIKE', "%{$search}%");
            });
        })->when($search_aircraft_registration, function ($query) use ($search_aircraft_registration) {
            $query->where('AIRCRAFT_REGISTRATION', 'LIKE', "%{$search_aircraft_registration}%");
        })->when($search_aircraft_type, function ($query) use ($search_aircraft_type) {
            $query->where('AIRCRAFT_TYPE', 'LIKE', "%{$search_aircraft_type}%");
        })->when($search_operator, function ($query) use ($search_operator) {
            $query->where('OPERATOR', 'LIKE', "%{$search_operator}%");
        })->when($search_date_aircraft_in, function ($query) use ($search_date_aircraft_in) {
            $query->whereDate('DATE_AIRCRAFT_IN', $search_date_aircraft_in);
        })->when($search_date_aircraft_out, function ($query) use ($search_date_aircraft_out) {
            $query->whereDate('DATE_AIRCRAFT_OUT', $search_date_aircraft_out);
        })->when($search_rksp, function ($query) use ($search_rksp) {
            $query->where('RKSP', 'LIKE', "%{$search_rksp}%");
        })->when($search_flight_route, function ($query) use ($search_flight_route) {
            $query->where('FLIGHT_ROUTE', 'LIKE', "%{$search_flight_route}%");
        })->when($search_crews, function ($query) use ($search_crews) {
            $query->where('CREWS', 'LIKE', "%{$search_crews}%");
        })->when($search_report, function ($query) use ($search_report) {
            $query->where('REPORT', 'LIKE', "%{$search_report}%");
        })->when(($order && $by), function ($query) use ($order, $by) {
            $query->orderBy($order, $by);
        })->paginate($paginate);

        $result = [
            'search' => $search,
            'order' => $order,
            'by' => $by,
            'paginate' => $paginate,
        ];

        $aircraft->appends($result);
        return $aircraft;
    }

    public function createDelivery(Request $request)
    {
        $this->recordActivity('Akses Aircraft Delivery');

        $request->validate([
            'OPERATOR' => 'required',
            'AIRCRAFT_REGISTRATION' => 'required|unique:aircraft',
            'AIRCRAFT_TYPE' => 'required',
            'DATE_AIRCRAFT_IN' => 'required',
        ], [
            'OPERATOR.required' => 'Operator tidak boleh kosong',
            'AIRCRAFT_REGISTRATION.required' => 'Aircraft Registration tidak boleh kosong',
            'AIRCRAFT_REGISTRATION.unique' => 'Aircraft Registration sudah terdaftar',
            'AIRCRAFT_TYPE.required' => 'Aircraft Type tidak boleh kosong',
            'DATE_AIRCRAFT_IN.required' => 'Actual Time Arrival tidak boleh kosong',
        ]);

        $data = $request->all();

        if ($request->hasFile('RKSP')) {
            $file = $request->file('RKSP');
            $fileName = $file->getClientOriginalName();
            $file->move('uploads/rksp', $fileName);
            $data['RKSP'] = $fileName;
        }

        $delivery = Aircraft::create($data);

        return response()->json([
            'success' => 'Success',
            'message' => 'Aircraft Delivery Created Successfully',
            'data' => $delivery
        ], 200);
    }


    public function createRedelivery(Request $request)
    {
        $this->recordActivity('Akses Aircraft Delivery');

        $request->validate([
            'OPERATOR' => 'required',
            'AIRCRAFT_TYPE' => 'required',
            'AIRCRAT_REGISTRATION' => 'required',
            'DATE_AIRCRAFT_OUT' => 'required',

        ], [
            'OPERATOR.required' => 'Operator tidak boleh kosong',
            'AIRCRAFT_TYPE.required' => 'Aircraft Type tidak boleh kosong',
            'AIRCRAT_REGISTRATION.required' => 'Aircraft Registration tidak boleh kosong',
            'DATE_AIRCRAFT_OUT.required' => 'Actual Time Departure tidak boleh kosong',
        ]);

        if ($redelivery = Aircraft::where('AIRCRAFT_REGISTRATION', $request->AIRCRAT_REGISTRATION)->first()) {
            $redelivery->update([
                'DATE_AIRCRAFT_OUT' => $request->DATE_AIRCRAFT_OUT,

            ]);
            return response()->json([
                'success' => 'Success',
                'message' => 'Aircraft Redelivery Created Successfully',
                'data' => $redelivery
            ], 200);
        } else {
            return response()->json([
                'success' => 'Failed',
                'message' => 'Failed to create Aircraft Redelivery',
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $search = $request->get('search');

        $aircraft = Aircraft::when($search, function ($query) use ($search) {
            $query->where(function ($sub_query) use ($search) {
                $sub_query->where('AIRCRAFT_REGISTRATION', 'LIKE', "%{$search}%");
            });
        })
            ->where('DATE_AIRCRAFT_OUT', null)
            ->get();

        return $aircraft;
    }


    public function destroy($id)
    {
        $this->recordActivity('Delete Aircraft Mutation');

        $this->authorize('isAdmin');
        // Hapus data Aircraft Mutation
        $aircraft = Aircraft::find($id);
        $aircraft->delete();

        return response()->json([
            'success' => 'Success',
            'message' => 'Aircraft Mutation Deleted Successfully',
        ], 200);
    }
}