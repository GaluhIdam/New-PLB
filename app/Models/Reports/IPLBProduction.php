<?php

namespace App\Models\Reports;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IPLBProduction extends Model
{
    use HasFactory;
    protected $connection = 'iplb_db_prod';
    protected $table = 'plb_header';

    public function getOutbound28()
    {
        $start_date = $start_date ?? date('Y-m-d', strtotime('-1 day', strtotime(now())));
        $end_date = $end_date ?? date('Y-m-d', strtotime('+1 day', strtotime(now())));

        $query = DB::connection('iplb_db_prod')->table('plb_header')
            ->select(
                'iplb_db_prod.plb_header.NOMOR_AJU',
                'iplb_db_prod.plb_header.NOMOR_DAFTAR',
                'iplb_db_prod.plb_header.TANGGAL_DAFTAR',
                'iplb_db_prod.plb_header.KODE_DOKUMEN_PABEAN',
                'iplb_db_prod.plb_header.TANGGAL_AJU',
                'plb_db_prod.tpb_kemasan.WAKTU_GATE_OUT',
                'iplb_db_prod.plb_header.NAMA_PEMILIK',
                'iplb_db_prod.plb_barang.ID',
                'iplb_db_prod.plb_barang.KODE_BARANG',
                'iplb_db_prod.plb_barang.POS_TARIF',
                'iplb_db_prod.plb_barang.URAIAN',
                'iplb_db_prod.plb_barang.JUMLAH_SATUAN',
                'iplb_db_prod.plb_barang.KODE_SATUAN',
                'iplb_db_prod.plb_barang.CIF_RUPIAH as CIF_RUPIAH_BARANG',
            )
            ->leftJoin('plb_db_prod.tpb_kemasan', 'plb_db_prod.tpb_kemasan.ID_HEADER', '=', 'iplb_db_prod.plb_header.ID')
            ->leftJoin('iplb_db_prod.plb_barang', 'iplb_db_prod.plb_barang.ID_HEADER', '=', 'iplb_db_prod.plb_header.ID')
            ->whereIn('iplb_db_prod.plb_header.KODE_DOKUMEN_PABEAN', [28])
            ->whereNotNull('iplb_db_prod.plb_header.NOMOR_DAFTAR')
            ->where('iplb_db_prod.plb_header.NOMOR_DAFTAR', '!=', '')
            ->whereBetween('iplb_db_prod.plb_header.TANGGAL_AJU', [$start_date, $end_date]);

        $result = $this->getData($query);
        return $result;
    }
}