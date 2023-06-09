<?php

namespace App\Imports\Uploads;

use Illuminate\Support\Facades\Auth;
use App\Models\Uploads\MutationReport;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;



class ImportMutationReport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, ShouldQueue
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
                'kode_barang' => $row['kode_barang'],
                'uraian' => $row['uraian_barang'],
                'kode_satuan' => $row['satuan'],
                'saldo_awal' => $row['saldo_awal'],
                'tipe_saldo' => $saldoType,
                'uploaded_at' => Carbon::parse(substr($this->uploaded_at, 0, strpos($this->uploaded_at, " ("))),
            ]);
        } else {
            return new MutationReport([
                'kode_barang' => $row['kode_barang'],
                'uraian' => $row['uraian_barang'],
                'kode_satuan' => $row['satuan'],
                'saldo_akhir' => $row['saldo_akhir'],
                'tipe_saldo' => $saldoType,
                'uploaded_at' => Carbon::parse(substr($this->uploaded_at, 0, strpos($this->uploaded_at, " ("))),
            ]);
        }
    }

    public function chunkSize(): int
    {
        return 2000;
    }

    public function batchSize(): int
    {
        return 2000;
    }
}
