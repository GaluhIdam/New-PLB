<?php

namespace App\Models\Costums;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Outbound extends Model
{

    /* Select Columns 
    Jenis Dokumen = iplb_db_prod.plb_header.KODE_DOKUMEN_PABEAN
    Nomor Aju = iplb_db_prod.plb_header.NOMOR_AJU
    Tanggal AJU = iplb_db_prod.plb_header.TANGGAL_AJU
    Nomor Daftar = iplb_db_prod.plb_header.NOMOR_DAFTAR
    Tanggal Daftar = iplb_db_prod.plb_header.TANGGAL_DAFTAR
    Tanggal Pengeluaran = iplb_db_prod.plb_header.TANGGAL_DAFTAR
    Nama Pemilik = iplb_db_prod.plb_header.NAMA_PEMILIK
    Kode Barang = iplb_db_prod.plb_barang.KODE_BARANG
    Kode HS = iplb_db_prod.plb_barang.POS_TARIF
    Nama Barang = iplb_db_prod.plb_barang.URAIAN
    Jumlah = iplb_db_prod.plb_barang.JUMLAH_SATUAN
    Satuan = iplb_db_prod.plb_barang.KODE_SATUAN
    Nilai Barang = iplb_db_prod.plb_barang.CIF_RUPIAH
    */
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
                'iplb_db_prod.plb_barang.ID',
                'iplb_db_prod.plb_barang.KODE_BARANG',
                'iplb_db_prod.plb_barang.POS_TARIF',
                'iplb_db_prod.plb_barang.URAIAN',
                'iplb_db_prod.plb_barang.JUMLAH_SATUAN',
                'iplb_db_prod.plb_barang.KODE_SATUAN',
                'iplb_db_prod.plb_barang.CIF_RUPIAH'
            )
            ->leftJoin('iplb_db_prod.plb_barang', 'iplb_db_prod.plb_header.ID', '=', 'iplb_db_prod.plb_barang.ID_HEADER');
        // ->where('iplb_db_prod.plb_header.KODE_DOKUMEN_PABEAN', '=', 27)
        // ->whereNotNull('iplb_db_prod.plb_header.NOMOR_DAFTAR');

        return $query;
    }
}