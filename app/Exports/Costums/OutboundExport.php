<?php

namespace App\Exports\Costums;

use App\Models\Costums\Outbound;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class OutboundExport implements FromView
{
    public function view(): View
    {
        $costums = Outbound::take(2000)->orderBy('TANGGAL_AJU', 'DESC')->get();
        return view('exports.costums.outbound', compact('costums'));
    }
}
