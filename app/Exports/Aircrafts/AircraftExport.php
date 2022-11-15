<?php

namespace App\Exports\Aircrafts;

use App\Models\Aircraft;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class AircraftExport implements FromView
{
    public $search;
    public $search_aircraft_registration;
    public $search_aircraft_type;
    public $search_operator;
    public $search_date_aircraft_in;
    public $search_date_aircraft_out;
    public $search_rksp;
    public $search_flight_route;
    public $search_crews;
    public $search_report;
    public $search_status;
    public $order;
    public $by;

    public function __construct(
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
    ) {
        $this->search = $search;
        $this->search_aircraft_registration = $search_aircraft_registration;
        $this->search_aircraft_type = $search_aircraft_type;
        $this->search_operator = $search_operator;
        $this->search_date_aircraft_in = $search_date_aircraft_in;
        $this->search_date_aircraft_out = $search_date_aircraft_out;
        $this->search_rksp = $search_rksp;
        $this->search_flight_route = $search_flight_route;
        $this->search_crews = $search_crews;
        $this->search_report = $search_report;
        $this->search_status = $search_status;
        $this->order = $order;
        $this->by = $by;
    }


    public function view(): View
    {
        $search = $this->search;
        $search_aircraft_registration = $this->search_aircraft_registration;
        $search_aircraft_type = $this->search_aircraft_type;
        $search_operator = $this->search_operator;
        $search_date_aircraft_in = $this->search_date_aircraft_in;
        $search_date_aircraft_out = $this->search_date_aircraft_out;
        $search_rksp = $this->search_rksp;
        $search_flight_route = $this->search_flight_route;
        $search_crews = $this->search_crews;
        $search_report = $this->search_report;
        $search_status = $this->search_status;
        $order = $this->order;
        $by = $this->by;

        $aircrafts = Aircraft::when($search, function ($query) use ($search) {
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
        })->get();

        return view('exports.aircrafts.mutation', compact('aircrafts'));
    }
}