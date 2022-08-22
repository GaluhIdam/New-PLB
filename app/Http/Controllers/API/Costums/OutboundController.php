<?php

namespace App\Http\Controllers\API\Costums;

use App\Http\Controllers\Controller;
use App\Models\Costums\Outbound;
use Illuminate\Http\Request;

class OutboundController extends Controller
{
    /* 
    List Data yang ditampilkan pada tabel :
    1. Kode Dokumen Pabean [iplb_db_prod.plb_header.KODE_DOKUMEN_PABEAN]
    2. Nomor Aju [iplb_db_prod.plb_header.NOMOR_AJU]
    3. Tanggal AJU [iplb_db_prod.plb_header.TANGGAL_AJU]
    4. Nomor Daftar [iplb_db_prod.plb_header.NOMOR_DAFTAR]
    5. Tanggal Daftar [iplb_db_prod.plb_header.TANGGAL_DAFTAR]
    6. Tanggal Pengeluaran [iplb_db_prod.plb_header.TANGGAL_DAFTAR]
    7. Nama Pemilik [iplb_db_prod.plb_header.NAMA_PEMILIK]
    8. Kode Barang [iplb_db_prod.plb_barang.KODE_BARANG]
    9. Kode HS [iplb_db_prod.plb_barang.POS_TARIF]
    10. Nama Barang [iplb_db_prod.plb_barang.URAIAN]
    11. Jumlah [iplb_db_prod.plb_barang.JUMLAH_SATUAN]
    12. Satuan [iplb_db_prod.plb_barang.KODE_SATUAN]
    13. Nilai Barang [iplb_db_prod.plb_barang.CIF_RUPIAH]
    */

    public function index(Request $request)
    {
        //  Search
        $search = $request->get('search');
        $search_kode_dokumen_pabean = $request->get('search_kode_dokumen_pabean');
        $search_nomor_aju = $request->get('search_nomor_aju');
        $search_tanggal_aju = $request->get('search_tanggal_aju');
        $search_nomor_daftar = $request->get('search_nomor_daftar');
        $search_tanggal_daftar = $request->get('search_tanggal_daftar');
        $search_tanggal_pengeluaran = $request->get('search_tanggal_pengeluaran');
        $search_nama_pemilik = $request->get('search_nama_pemilik');
        $search_kode_barang = $request->get('search_kode_barang');
        $search_kode_hs = $request->get('search_kode_hs');
        $search_nama_barang = $request->get('search_nama_barang');
        $search_jumlah_satuan = $request->get('search_jumlah_satuan');
        $search_kode_satuan = $request->get('search_kode_satuan');
        $search_cif_rupiah = $request->get('search_cif_rupiah');

        // Filter
        $filter_start_date = $request->get('filter_start_date');
        $filter_end_date = $request->get('filter_end_date');
        $filter_kode_dokumen_pabean = $request->get('filter_kode_dokumen_pabean');
        $filter_nomor_aju = $request->get('filter_nomor_aju');

        // Sort
        if ($request->get('order') && $request->get('by')) {
            $order = $request->get('order');
            $by = $request->get('by');
        } else {
            $order = 'ID';
            $by = 'desc';
        }
        if ($request->get('paginate')) {
            $paginate = $request->get('paginate');
        } else {
            $paginate = 10;
        }

        // Query
        $outbounds = Outbound::newOutbound()->when($search, function ($query) use ($search) {
            $query->where(function ($sub_query) use ($search) {
                $sub_query->whereIn('plb_db_prod.tpb_header.KODE_DOKUMEN_PABEAN', "=", 27)
                    ->orWhere('plb_db_prod.tpb_header.KODE_DOKUMEN_PABEAN', 'LIKE', "%$search%")
                    ->orWhere('plb_db_prod.tpb_header.NOMOR_AJU', 'LIKE', "%$search%")
                    ->orWhere('plb_db_prod.tpb_header.TANGGAL_AJU', 'LIKE', "%$search%")
                    ->orWhere('plb_db_prod.tpb_header.NOMOR_DAFTAR', 'LIKE', "%$search%")
                    ->orWhere('plb_db_prod.tpb_header.TANGGAL_DAFTAR', 'LIKE', "%$search%")
                    ->orWhere('plb_db_prod.tpb_header.TANGGAL_DAFTAR', 'LIKE', "%$search%")
                    ->orWhere('plb_db_prod.tpb_header.NAMA_PEMILIK', 'LIKE', "%$search%")
                    ->orWhere('plb_db_prod.tpb_barang.KODE_BARANG', 'LIKE', "%$search%")
                    ->orWhere('plb_db_prod.tpb_barang.POS_TARIF', 'LIKE', "%$search%")
                    ->orWhere('plb_db_prod.tpb_barang.URAIAN', 'LIKE', "%$search%")
                    ->orWhere('plb_db_prod.tpb_barang.JUMLAH_SATUAN', 'LIKE', "%$search%")
                    ->orWhere('plb_db_prod.tpb_barang.KODE_SATUAN', 'LIKE', "%$search%")
                    ->orWhere('plb_db_prod.tpb_barang.CIF_RUPIAH', 'LIKE', "%$search%");
            });
        })
            ->when($search_kode_dokumen_pabean, function ($query) use ($search_kode_dokumen_pabean) {
                $query->where('plb_db_prod.tpb_header.KODE_DOKUMEN_PABEAN', 'LIKE', "%$search_kode_dokumen_pabean%");
            })
            ->when($search_nomor_aju, function ($query) use ($search_nomor_aju) {
                $query->where('plb_db_prod.tpb_header.NOMOR_AJU', 'LIKE', "%$search_nomor_aju%");
            })
            ->when($search_tanggal_aju, function ($query) use ($search_tanggal_aju) {
                $query->where('plb_db_prod.tpb_header.TANGGAL_AJU', 'LIKE', "%$search_tanggal_aju%");
            })
            ->when($search_nomor_daftar, function ($query) use ($search_nomor_daftar) {
                $query->where('plb_db_prod.tpb_header.NOMOR_DAFTAR', 'LIKE', "%$search_nomor_daftar%");
            })
            ->when($search_tanggal_daftar, function ($query) use ($search_tanggal_daftar) {
                $query->where('plb_db_prod.tpb_header.TANGGAL_DAFTAR', 'LIKE', "%$search_tanggal_daftar%");
            })
            ->when($search_tanggal_pengeluaran, function ($query) use ($search_tanggal_pengeluaran) {
                $query->where('plb_db_prod.tpb_header.TANGGAL_DAFTAR', 'LIKE', "%$search_tanggal_pengeluaran%");
            })
            ->when($search_nama_pemilik, function ($query) use ($search_nama_pemilik) {
                $query->where('plb_db_prod.tpb_header.NAMA_PEMILIK', 'LIKE', "%$search_nama_pemilik%");
            })
            ->when($search_kode_barang, function ($query) use ($search_kode_barang) {
                $query->where('plb_db_prod.tpb_barang.KODE_BARANG', 'LIKE', "%$search_kode_barang%");
            })
            ->when($search_kode_hs, function ($query) use ($search_kode_hs) {
                $query->where('plb_db_prod.tpb_barang.POS_TARIF', 'LIKE', "%$search_kode_hs%");
            })
            ->when($search_nama_barang, function ($query) use ($search_nama_barang) {
                $query->where('plb_db_prod.tpb_barang.URAIAN', 'LIKE', "%$search_nama_barang%");
            })
            ->when($search_jumlah_satuan, function ($query) use ($search_jumlah_satuan) {
                $query->where('plb_db_prod.tpb_barang.JUMLAH_SATUAN', 'LIKE', "%$search_jumlah_satuan%");
            })
            ->when($search_kode_satuan, function ($query) use ($search_kode_satuan) {
                $query->where('plb_db_prod.tpb_barang.KODE_SATUAN', 'LIKE', "%$search_kode_satuan%");
            })
            ->when($search_cif_rupiah, function ($query) use ($search_cif_rupiah) {
                $query->where('plb_db_prod.tpb_barang.CIF_RUPIAH', 'LIKE', "%$search_cif_rupiah%");
            })
            // Filter
            ->when($filter_kode_dokumen_pabean, function ($query) use ($filter_kode_dokumen_pabean) {
                $query->whereIn('iplb_db_prod.plb_header.KODE_DOKUMEN_PABEAN', 'LIKE', "%$filter_kode_dokumen_pabean%");
            })
            ->when($filter_nomor_aju, function ($query) use ($filter_nomor_aju) {
                $query->where('iplb_db_prod.plb_header.NOMOR_AJU', 'LIKE', "%$filter_nomor_aju%");
            })
            ->when($filter_start_date, function ($query) use ($filter_start_date) {
                $query->where('iplb_db_prod.plb_header.TANGGAL_DAFTAR', 'LIKE', "%$filter_start_date%");
            })
            ->when($filter_end_date, function ($query) use ($filter_end_date) {
                $query->where('iplb_db_prod.plb_header.TANGGAL_DAFTAR', 'LIKE', "%$filter_end_date%");
            })->when(($order && $by), function ($query) use ($order, $by) {
                $query->orderBy($order, $by);
            })->paginate($paginate);

        $query_string = [
            'search' => $search,
            'order' => $order,
            'by' => $by,
            'paginate' => $paginate,
        ];

        $outbounds = $outbounds->appends($query_string);
        return $outbounds;
    }
}