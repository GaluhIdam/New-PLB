<?php

namespace App\Exports\Outbounds;

use App\Models\Outbound\TransactionTwo;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class TransactionTwoExport implements FromView
{
    public function view(): View
    {
        $outbounds = TransactionTwo::take(2000)->orderBy('DATE_INSTALL', 'desc')->get();
        return view('exports.outbounds.transaction_two', compact('outbounds'));
    }
}
