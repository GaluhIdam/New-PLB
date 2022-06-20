<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoardingTime extends Model
{
    use HasFactory;
    protected $fillable = [
        'bc_16_code', //Kode BC 1.6
        'registration_date', // Tanggal Pendaftaran
        'registration_number', //Nomor Pendaftaran
        'submission number', // Nomor Pengajuan
        'date_of_filing', // Tanggal Pengajuan
        'item_code', // Kode Barang
        'item_name', // Nama Barang
        'unit', // Satuan
        'total', // Jumlah
        'status', // Status

        // Other
        'beginning_balance', // Saldo Awal
        //  BC 1.6 In & Out
        'code_bc_16_in', // Masuk BC 1.6
        'code_bc_16_out', // Keluar BC 1.6
        // BC 2.7 In & Out
        'code_bc_27_in', // Masuk BC 2.7
        'code_bc_27_out', // Keluar BC 2.7
        // BC 2.8 In & Out
        'code_bc_28_in', // Masuk BC 2.8
        'code_bc_28_out', // Keluar BC 2.8
        // BC 3.0 In & Out
        'code_bc_30_in', // Masuk BC 3.0
        'code_bc_30_out', // Keluar BC 3.0
        // BC 4.0 In & Out
        'code_bc_40_in', // Masuk BC 4.0
        'code_bc_40_out', // Keluar BC 4.0
        // BC 4.1 In & Out
        'code_bc_41_in', // Masuk BC 4.1
        'code_bc_41_out', // Keluar BC 4.1
        'adjustment', // Penyesuaian
        'book_balance', // Saldo Buku
        'inventory_taking', // Stock Opname
        'difference', // Selisih
        'created_date', // Tanggal Pembuatan
        'created_time', // Waktu Pembuatan
    ];
}
