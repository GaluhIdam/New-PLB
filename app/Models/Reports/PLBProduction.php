<?php

namespace App\Models\Reports;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PLBProduction extends Model
{
    use HasFactory;
    protected $connection = 'plb_db_prod';
    protected $table = 'tpb_header';

    public function scopeNewInbound($query)
    {
        $jenis_dokumen = $jenis_dokumen ?? [27, 16, 40];
        $start_date =  $start_date ?? date('Y-m-d', strtotime('-1 day', strtotime(now())));
        $end_date = $end_date ?? date('Y-m-d', strtotime('+1 day', strtotime(now()))); {
            $query = DB::connection('plb_db_prod')->table('tpb_header')
                ->select(
                    'plb_db_prod.tpb_header.KODE_DOKUMEN_PABEAN',
                    'plb_db_prod.tpb_header.NOMOR_AJU',
                    'plb_db_prod.tpb_header.TANGGAL_AJU',
                    'plb_db_prod.tpb_header.NOMOR_DAFTAR',
                    'plb_db_prod.tpb_header.TANGGAL_DAFTAR',
                    'plb_db_prod.tpb_kemasan.WAKTU_GATE_IN',
                    'plb_db_prod.tpb_header.NAMA_PENGIRIM',
                    'plb_db_prod.tpb_header.NAMA_PENGUSAHA',
                    'plb_db_prod.tpb_header.NAMA_PEMILIK',
                    'plb_db_prod.tpb_barang.ID',
                    'plb_db_prod.tpb_barang.KODE_BARANG',
                    'plb_db_prod.tpb_barang.POS_TARIF',
                    'plb_db_prod.tpb_barang.URAIAN',
                    'plb_db_prod.tpb_barang.JUMLAH_SATUAN',
                    'plb_db_prod.tpb_barang.KODE_SATUAN',
                    'plb_db_prod.tpb_barang.HARGA_PENYERAHAN',
                    'plb_db_prod.tpb_barang.CIF',
                    'plb_db_prod.tpb_header.KODE_KANTOR_TUJUAN',
                )
                ->leftJoin('plb_db_prod.tpb_barang', 'plb_db_prod.tpb_barang.ID_HEADER', '=', 'plb_db_prod.tpb_header.ID')
                ->leftJoin('plb_db_prod.tpb_kemasan', 'plb_db_prod.tpb_kemasan.ID_HEADER', '=', 'plb_db_prod.tpb_header.ID')
                ->whereIn('plb_db_prod.tpb_header.KODE_DOKUMEN_PABEAN', [27])
                ->where('plb_db_prod.tpb_header.KODE_KANTOR_TUJUAN', '=', '050100')
                ->where('plb_db_prod.tpb_header.TANGGAL_AJU', '>=', $start_date)
                ->where('plb_db_prod.tpb_header.TANGGAL_AJU', '<=', $end_date)
                ->whereNotNull('plb_db_prod.tpb_header.NOMOR_DAFTAR')
                ->where('plb_db_prod.tpb_header.NOMOR_DAFTAR', '!=', '')
                ->orWhereIn('plb_db_prod.tpb_header.KODE_DOKUMEN_PABEAN', [16, 40])
                ->where('plb_db_prod.tpb_header.TANGGAL_AJU', '>=', $start_date)
                ->where('plb_db_prod.tpb_header.TANGGAL_AJU', '<=', $end_date)
                ->whereNotNull('plb_db_prod.tpb_header.NOMOR_DAFTAR')
                ->where('plb_db_prod.tpb_header.NOMOR_DAFTAR', '!=', '');
        }
    }
}