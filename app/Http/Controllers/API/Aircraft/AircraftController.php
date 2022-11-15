<?php

namespace App\Http\Controllers\API\Aircraft;

use App\Models\Aircraft;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Aircrafts\AircraftExport;

class AircraftController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

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
        $search_status = $request->get('search_status');

        // Sort Data
        if ($request->get('order') && $request->get('by')) {
            $order = $request->get('order');
            $by = $request->get('by');
        } else {
            $order = 'id';
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
                $sub_query->where('reg', 'LIKE', "%{$search}%")
                    ->orWhere('type', 'LIKE', "%{$search}%")
                    ->orWhere('operator', 'LIKE', "%{$search}%")
                    ->orWhere('date_in', 'LIKE', "%{$search}%")
                    ->orWhere('date_out', 'LIKE', "%{$search}%")
                    ->orWhere('rksp', 'LIKE', "%{$search}%")
                    ->orWhere('fight_route', 'LIKE', "%{$search}%")
                    ->orWhere('crews', 'LIKE', "%{$search}%")
                    ->orWhere('report', 'LIKE', "%{$search}%")
                    ->orWhere('status', 'LIKE', "%{$search}%");
            });
        })->when($search_aircraft_registration, function ($query) use ($search_aircraft_registration) {
            $query->where('reg', 'LIKE', "%{$search_aircraft_registration}%");
        })->when($search_aircraft_type, function ($query) use ($search_aircraft_type) {
            $query->where('type', 'LIKE', "%{$search_aircraft_type}%");
        })->when($search_operator, function ($query) use ($search_operator) {
            $query->where('operator', 'LIKE', "%{$search_operator}%");
        })->when($search_date_aircraft_in, function ($query) use ($search_date_aircraft_in) {
            $query->whereDate('date_in', $search_date_aircraft_in);
        })->when($search_date_aircraft_out, function ($query) use ($search_date_aircraft_out) {
            $query->whereDate('date_out', $search_date_aircraft_out);
        })->when($search_rksp, function ($query) use ($search_rksp) {
            $query->where('rksp', 'LIKE', "%{$search_rksp}%");
        })->when($search_flight_route, function ($query) use ($search_flight_route) {
            $query->where('fight_route', 'LIKE', "%{$search_flight_route}%");
        })->when($search_crews, function ($query) use ($search_crews) {
            $query->where('crews', 'LIKE', "%{$search_crews}%");
        })->when($search_report, function ($query) use ($search_report) {
            $query->where('report', 'LIKE', "%{$search_report}%");
        })->when($search_status, function ($query) use ($search_status) {
            $query->where('status', 'LIKE', "%{$search_status}%");
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
            'operator' => 'required',
            'reg' => 'required|unique:aircraft',
            'type' => 'required',
            'date_in' => 'required',
        ], [
            'operator.required' => 'Operator tidak boleh kosong',
            'reg.required' => 'Aircraft Registration tidak boleh kosong',
            'reg.unique' => 'Aircraft Registration sudah terdaftar',
            'type.required' => 'Aircraft Type tidak boleh kosong',
            'date_in.required' => 'Actual Time Arrival tidak boleh kosong',
        ]);

        $data = $request->all();

        if ($request->hasFile('rksp')) {
            $path = $request->file('rksp')->store('uploaded_documents', 'public');
            $data['rksp'] = $path;
        }

        $delivery = Aircraft::create([
            'operator' => $data['operator'],
            'reg' => $data['reg'],
            'type' => $data['type'],
            'date_in' => $data['date_in'],
            'rksp' => $data['rksp'],
            'status' => 'Di dalam PLB GMF',
        ]);

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
            'operator' => 'required',
            'type' => 'required',
            'reg' => 'required',
            'date_out' => 'required',

        ], [
            'operator.required' => 'Operator tidak boleh kosong',
            'type.required' => 'Aircraft Type tidak boleh kosong',
            'reg.required' => 'Aircraft Registration tidak boleh kosong',
            'date_out.required' => 'Actual Time Departure tidak boleh kosong',
        ]);

        if ($redelivery = Aircraft::where('reg', $request->reg)->first()) {
            $redelivery->update([
                'date_out' => $request->date_out,
                'status' => 'Di luar PLB GMF',
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
                $sub_query->where('reg', 'LIKE', "%{$search}%");
            });
        })
            ->where('date_out', null)
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

    public function exportCsv(Request $request)
    {
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
        $search_status = $request->get('search_status');

        // Sort Data
        if ($request->get('order') && $request->get('by')) {
            $order = $request->get('order');
            $by = $request->get('by');
        } else {
            $order = 'id';
            $by = 'desc';
        }

        return Excel::download(new AircraftExport(
            $search,
            $search_aircraft_registration,
            $search_aircraft_type,
            $search_operator,
            $search_date_aircraft_in,
            $search_date_aircraft_out,
            $search_rksp,
            $search_flight_route,
            $search_crews,
            $search_report,
            $search_status,
            $order,
            $by
        ), 'aircraft-mutations.csv');
    }

    public function exportExcel(Request $request)
    {
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
        $search_status = $request->get('search_status');

        // Sort Data
        if ($request->get('order') && $request->get('by')) {
            $order = $request->get('order');
            $by = $request->get('by');
        } else {
            $order = 'id';
            $by = 'desc';
        }

        return Excel::download(new AircraftExport(
            $search,
            $search_aircraft_registration,
            $search_aircraft_type,
            $search_operator,
            $search_date_aircraft_in,
            $search_date_aircraft_out,
            $search_rksp,
            $search_flight_route,
            $search_crews,
            $search_report,
            $search_status,
            $order,
            $by
        ), 'aircraft-mutations.xlsx');
    }
}