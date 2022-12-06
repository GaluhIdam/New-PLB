<?php

namespace App\Imports\Uploads;

use Illuminate\Support\Facades\Auth;
use App\Models\Uploads\MutationReport;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportMutationReport implements ToModel
{
    public function model(array $row)
    {
        return new MutationReport([
            'part_number' => $row[1],
            'part_name' => $row[2],
            'unit' => $row[3],
            'saldo_awal ' => $row[4],
            'imported_by' => Auth::user()->name
        ]);
    }
}