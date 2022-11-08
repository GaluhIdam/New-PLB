<?php

namespace App\Exports\Costums;

use App\Models\Costums\Inbound;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class InboundExport implements FromView
{
    public function view(): View
    {
        $costums = Inbound::take(2000)->orderBy('TANGGAL_AJU', 'DESC')->get();
        return view('exports.costums.inbound', compact('costums'));
    }
}
