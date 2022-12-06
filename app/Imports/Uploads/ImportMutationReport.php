<?php

namespace App\Imports\Uploads;

use Illuminate\Support\Facades\Auth;
use App\Models\Uploads\MutationReport;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportMutationReport implements ToModel
{
    public $saldo_type;
    public $uploaded_at;

    public function __construct($saldo_type, $uploaded_at)
    {
        $this->saldo_type = $saldo_type;
        $this->uploaded_at = $uploaded_at;
    }

    public function model(array $row)
    {
        $removeUnderScore = str_replace('_', ' ', $this->saldo_type);
        $saldoType = ucwords($removeUnderScore);

        if ($this->saldo_type == 'saldo_awal') {
            return new MutationReport([
                'part_number' => $row[0],
                'part_name' => $row[1],
                'unit' => $row[2],
                'saldo_awal' => $row[3],
                'saldo_type' => $saldoType,
                'uploaded_at' => Carbon::parse(substr($this->uploaded_at, 0, strpos($this->uploaded_at, " ("))),
            ]);
        } else {
            return new MutationReport([
                'part_number' => $row[0],
                'part_name' => $row[1],
                'unit' => $row[2],
                'saldo_akhir' => $row[3],
                'saldo_type' => $saldoType,
                'uploaded_at' => Carbon::parse(substr($this->uploaded_at, 0, strpos($this->uploaded_at, " ("))),
            ]);
        }
    }
}