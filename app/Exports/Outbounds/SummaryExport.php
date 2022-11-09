<?php

namespace App\Exports\Outbounds;

use App\Models\Outbound\Summary;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class SummaryExport implements FromView
{
    public function view(): View
    {
        $outbounds = Summary::take(2000)->orderBy('DATE_INSTALL', 'desc')->get();
        return view('exports.outbounds.summary', compact('outbounds'));
    }
}