<?php

namespace App\Imports\Uploads;

use Illuminate\Support\Facades\Auth;
use App\Models\Uploads\MutationReport;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportMutationReport implements ToModel
{
    public $selectSaldo;
    public $uploaded_at;

    public function __construct($selectSaldo, $uploaded_at)
    {
        $this->selectSaldo = $selectSaldo;
        $this->uploaded_at = $uploaded_at;
    }

    public function model(array $row)
    {
        if ($this->selectSaldo == 'saldo_awal') {
            return new MutationReport([
                'part_number' => $row[0],
                'part_name' => $row[1],
                'unit' => $row[2],
                'saldo_awal' => $row[3],
                'uploaded_at' => Carbon::parse(substr($this->uploaded_at, 0, strpos($this->uploaded_at, " ("))),
            ]);
        } else {
            return new MutationReport([
                'part_number' => $row[0],
                'part_name' => $row[1],
                'unit' => $row[2],
                'saldo_akhir' => $row[3],
                'uploaded_at' => Carbon::parse(substr($this->uploaded_at, 0, strpos($this->uploaded_at, " ("))),
            ]);
        }
    }
}