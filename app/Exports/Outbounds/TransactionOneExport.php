<?php

namespace App\Exports\Outbounds;

use App\Models\Outbound\TransactionOne;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class TransactionOneExport implements FromView
{
    public function view(): View
    {
        $outbounds = TransactionOne::take(2000)->orderBy('DATE_INSTALL', 'desc')->get();
        return view('exports.outbounds.transaction_one', compact('outbounds'));
    }
}
