<?php

namespace App\Exports\Outbounds;

use App\Models\Outbound\TransactionThree;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class TransactionThreeExport implements FromView
{
    public function view(): View
    {
        $outbounds = TransactionThree::take(2000)->orderBy('DATE_INSTALL', 'desc')->get();
        return view('exports.outbounds.transaction_three', compact('outbounds'));
    }
}
