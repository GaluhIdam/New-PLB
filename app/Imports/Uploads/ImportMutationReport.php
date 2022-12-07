<?php

namespace App\Imports\Uploads;

use Illuminate\Support\Facades\Auth;
use App\Models\Uploads\MutationReport;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportMutationReport implements ToModel
{
    public $tipe_saldo;
    public $uploaded_at;

    public function __construct($tipe_saldo, $uploaded_at)
    {
        $this->tipe_saldo = $tipe_saldo;
        $this->uploaded_at = $uploaded_at;
    }

    public function model(array $row)
    {
        $removeUnderScore = str_replace('_', ' ', $this->tipe_saldo);
        $saldoType = ucwords($removeUnderScore);

        if ($this->tipe_saldo == 'saldo_awal') {
            return new MutationReport([
                'kode_barang' => $row[0],
                'uraian' => $row[1],
                'kode_satuan' => $row[2],
                'saldo_awal' => $row[3],
                'tipe_saldo' => $saldoType,
                'uploaded_at' => Carbon::parse(substr($this->uploaded_at, 0, strpos($this->uploaded_at, " ("))),
            ]);
        } else {
            return new MutationReport([
                'kode_barang' => $row[0],
                'uraian' => $row[1],
                'kode_satuan' => $row[2],
                'saldo_akhir' => $row[3],
                'tipe_saldo' => $saldoType,
                'uploaded_at' => Carbon::parse(substr($this->uploaded_at, 0, strpos($this->uploaded_at, " ("))),
            ]);
        }
    }
}