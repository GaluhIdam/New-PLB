<?php

namespace App\Models\Costums;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Outbound extends Model
{
    use HasFactory;
    protected $connection = 'iplb_db_prod';

    public function scopeNewOutbound($query)
    {
        $query = DB::connection('iplb_db_prod')->table('plb_header')
            ->select(
                'iplb_db_prod.plb_header.KODE_DOKUMEN_PABEAN',
                'iplb_db_prod.plb_header.NOMOR_AJU',
                'iplb_db_prod.plb_header.TANGGAL_AJU',
                'iplb_db_prod.plb_header.NOMOR_DAFTAR',
                'iplb_db_prod.plb_header.TANGGAL_DAFTAR',
                'iplb_db_prod.plb_header.NAMA_PEMILIK',
                'iplb_db_prod.plb_header.NAMA_PENERIMA_BARANG',
                'iplb_db_prod.plb_barang.ID',
                'iplb_db_prod.plb_barang.KODE_BARANG',
                'iplb_db_prod.plb_barang.POS_TARIF',
                'iplb_db_prod.plb_barang.URAIAN',
                'iplb_db_prod.plb_barang.JUMLAH_SATUAN',
                'iplb_db_prod.plb_barang.KODE_SATUAN',
                'iplb_db_prod.plb_barang.CIF',
                'iplb_db_prod.plb_barang.CIF_RUPIAH',
                'iplb_db_prod.plb_barang.HARGA_PENYERAHAN',
                'iplb_db_prod.plb_kemasan.WAKTU_GATE_OUT'
            )
            ->leftJoin('iplb_db_prod.plb_barang', 'iplb_db_prod.plb_header.ID', '=', 'iplb_db_prod.plb_barang.ID_HEADER')
            ->leftJoin('iplb_db_prod.plb_kemasan', 'iplb_db_prod.plb_header.ID', '=', 'iplb_db_prod.plb_kemasan.ID_HEADER');

        return $query;
    }
}