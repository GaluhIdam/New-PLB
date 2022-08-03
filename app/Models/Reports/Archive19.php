<?php

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive19 extends Model
{
    use HasFactory;
    protected $connection = 'plb_db_archive19';
    protected $table = 'tpb_header';

    protected $jenis_dokumen;
    protected $start_date;
    protected $end_date;

    public function scopeNewInbound($query)
    {
        $jenis_dokumen = $jenis_dokumen ?? ['27', '16', '40'];
        $start_date =  $start_date ?? date('Y-m-d', strtotime('-1 day', strtotime(now())));
        $end_date = $end_date ?? date('Y-m-d', strtotime('+1 day', strtotime(now())));

        return $query->select([
            'plb_db_archive19.tpb_header.KODE_DOKUMEN_PABEAN',
            'plb_db_archive19.tpb_header.NOMOR_AJU',
            'plb_db_archive19.tpb_header.TANGGAL_AJU',
            'plb_db_archive19.tpb_header.NOMOR_DAFTAR',
            'plb_db_archive19.tpb_header.TANGGAL_DAFTAR',
            'plb_db_archive19.tpb_kemasan.WAKTU_GATE_IN',
            'plb_db_archive19.tpb_header.NAMA_PENGIRIM',
            'plb_db_archive19.tpb_header.NAMA_PENGUSAHA',
            'plb_db_archive19.tpb_header.NAMA_PEMILIK',
            'plb_db_archive19.tpb_barang.ID',
            'plb_db_archive19.tpb_barang.KODE_BARANG',
            'plb_db_archive19.tpb_barang.POS_TARIF',
            'plb_db_archive19.tpb_barang.URAIAN',
            'plb_db_archive19.tpb_barang.JUMLAH_SATUAN',
            'plb_db_archive19.tpb_barang.KODE_SATUAN',
            'plb_db_archive19.tpb_barang.HARGA_PENYERAHAN',
            'plb_db_archive19.tpb_barang.CIF',
            'plb_db_archive19.tpb_header.KODE_KANTOR_TUJUAN',
        ])
            ->leftJoin('plb_db_archive19.tpb_barang', 'plb_db_archive19.tpb_barang.ID_HEADER', '=', 'plb_db_archive19.tpb_header.ID')
            ->leftJoin('plb_db_archive19.tpb_kemasan', 'plb_db_archive19.tpb_kemasan.ID_HEADER', '=', 'plb_db_archive19.tpb_header.ID')
            ->whereIn('plb_db_archive19.tpb_header.KODE_DOKUMEN_PABEAN', [$jenis_dokumen])
            ->where('plb_db_archive19.tpb_header.TANGGAL_AJU', '>=', $start_date)
            ->where('plb_db_archive19.tpb_header.TANGGAL_AJU', '<=', $end_date);
    }
}
