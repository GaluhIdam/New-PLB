<?php

namespace App\Models\Costums;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Request;

class Inbound extends Model
{
    use HasFactory;
    protected $connection = 'plb_db_prod';

    public function scopeNewInbound($query)
    {
        $query = DB::connection('plb_db_prod')->table('tpb_header')
            ->select(
                'plb_db_prod.tpb_header.KODE_DOKUMEN_PABEAN',
                'plb_db_prod.tpb_header.NOMOR_AJU',
                'plb_db_prod.tpb_header.TANGGAL_AJU',
                'plb_db_prod.tpb_header.NOMOR_DAFTAR',
                'plb_db_prod.tpb_header.TANGGAL_DAFTAR',
                'plb_db_prod.tpb_header.NAMA_PENGIRIM',
                'plb_db_prod.tpb_header.NAMA_PEMILIK',
                'plb_db_prod.tpb_barang.ID',
                'plb_db_prod.tpb_barang.KODE_BARANG',
                'plb_db_prod.tpb_barang.POS_TARIF',
                'plb_db_prod.tpb_barang.URAIAN',
                'plb_db_prod.tpb_barang.JUMLAH_SATUAN',
                'plb_db_prod.tpb_barang.KODE_SATUAN',
                'plb_db_prod.tpb_barang.HARGA_PENYERAHAN',
                'plb_db_prod.tpb_kemasan.WAKTU_GATE_IN',
                'plb_db_prod.tpb_kemasan.WAKTU_GATE_OUT'
            )
            ->leftJoin('plb_db_prod.tpb_barang', 'plb_db_prod.tpb_header.ID', '=', 'plb_db_prod.tpb_barang.ID_HEADER')
            ->leftJoin('plb_db_prod.tpb_kemasan', 'plb_db_prod.tpb_header.ID', '=', 'plb_db_prod.tpb_kemasan.ID_HEADER')
            ->whereIn('plb_db_prod.tpb_header.KODE_DOKUMEN_PABEAN', [27])
            ->whereNotNull('plb_db_prod.tpb_header.NOMOR_DAFTAR')
            ->where('plb_db_prod.tpb_header.NOMOR_DAFTAR', '!=', '')
            ->orWhereIn('plb_db_prod.tpb_header.KODE_DOKUMEN_PABEAN', [16, 40])
            ->whereNotNull('plb_db_prod.tpb_header.NOMOR_DAFTAR')
            ->where('plb_db_prod.tpb_header.NOMOR_DAFTAR', '!=', '');
        // ->where('plb_db_prod.tpb_header.KODE_DOKUMEN_PABEAN', '=', 27)
        // ->where('plb_db_prod.tpb_header.TANGGAL_AJU', '>=', $request->start_date)
        // ->where('plb_db_prod.tpb_header.TANGGAL_AJU', '<=', $request->end_date)
        // ->whereNotNull('plb_db_prod.tpb_header.NOMOR_DAFTAR')
        // ->where('plb_db_prod.tpb_header.NOMOR_DAFTAR', '!=', '')
        // ->limit(5)
        // ->get();

        return $query;
    }
}