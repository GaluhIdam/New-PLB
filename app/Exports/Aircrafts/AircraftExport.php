<?php

namespace App\Exports\Aircrafts;

use App\Models\Aircraft;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class AircraftExport implements FromView
{
    public function view(): View
    {
        $aircrafts = Aircraft::take(2000)->orderBy('id', 'desc')->get();
        return view('exports.aircrafts.mutation', compact('aircrafts'));
    }
}