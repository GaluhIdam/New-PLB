<?php

namespace App\Http\Controllers\API\Costums;

use App\Http\Controllers\Controller;
use App\Models\Costums\Outbound;
use Illuminate\Http\Request;

class OutboundController extends Controller
{
    /* 
    List Data yang dimunculin : 
    1. plb_db_prod.tpb_header.KODE_DOKUMEN_PABEAN [Kode Dokuemen Pabean] -> 1
    2. plb_db_prod.tpb_header.NOMOR_AJU [Nomor AJU] -> 2
    3. plb_db_prod.tpb_header.TANGGAL_AJU [Tanggal AJU] -> 3
    4. plb_db_prod.tpb_header.NOMOR_DAFTAR [Nomor DAFTAR] -> 4
    5. plb_db_prod.tpb_header.TANGGAL_DAFTAR [Tanggal DAFTAR] -> 5
    6. plb_db_prod.tpb_barang.NAMA_PEMILIK [Nama Pemilik] -> 7
    7. plb_db_prod.tpb_barang.KODE_BARANG [Kode Barang] -> 8
    8. plb_db_prod.tpb_barang.POS_TARIF [Kode HS] -> 9
    9. plb_db_prod.tpb_barang.URAIAN [Nama Barang] -> 10
    10. plb_db_prod.tpb_barang.JUMLAH_SATUAN [Jumlah ] -> 11
    11. plb_db_prod.tpb_barang.KODE_SATUAN [Satuan] -> 12
    12. plb_db_prod.tpb_barang.HARGA_PENYERAHAN [Harga Penyerahan] -> 13 [Jika Kode 41]
    13. plb_db_prod.tpb_barang.CIF [CIF]  -> 13 [Jika Kode 27] | Jika 0/Null Menggunakan Harga_Penyerahan
    14. plb_db_prod.tpb_barang.CIF_RUPIAH [CIF_RUPIAH]-> 13 [Jika Kode 28]
    15. plb_db_prod.tpb_kemasan.WAKTU_GATE_OUT [Tanggal Pengeluaran] -6
    */
    use \App\Http\Traits\ActivityHistoryTrait;
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index(Request $request)
    {
        $this->recordActivity('Akses Dokumen Kepabeanan (Outbound)');
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
        $search_harga_penyerahan = $request->get('search_harga_penyerahan');
        $search_cif = $request->get('search_cif');
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
                $sub_query->where('plb_db_prod.plb_header.KODE_DOKUMEN_PABEAN', 'LIKE', "%$search%")
                    ->orWhere('plb_db_prod.plb_header.NOMOR_AJU', 'LIKE', "%$search%")
                    ->orWhere('plb_db_prod.plb_header.TANGGAL_AJU', 'LIKE', "%$search%")
                    ->orWhere('plb_db_prod.plb_header.NOMOR_DAFTAR', 'LIKE', "%$search%")
                    ->orWhere('plb_db_prod.plb_header.TANGGAL_DAFTAR', 'LIKE', "%$search%")
                    ->orWhere('iplb_db_prod.plb_header.NAMA_PEMILIK', 'LIKE', "%$search%")
                    ->orWhere('iplb_db_prod.plb_barang.KODE_BARANG', 'LIKE', "%$search%")
                    ->orWhere('iplb_db_prod.plb_barang.POS_TARIF', 'LIKE', "%$search%")
                    ->orWhere('iplb_db_prod.plb_barang.URAIAN', 'LIKE', "%$search%")
                    ->orWhere('iplb_db_prod.plb_barang.JUMLAH_SATUAN', 'LIKE', "%$search%")
                    ->orWhere('iplb_db_prod.plb_barang.KODE_SATUAN', 'LIKE', "%$search%")
                    ->orWhere('iplb_db_prod.plb_barang.HARGA_PENYERAHAN', 'LIKE', "%$search%")
                    ->orWhere('iplb_db_prod.plb_barang.CIF', 'LIKE', "%$search%")
                    ->orWhere('iplb_db_prod.plb_barang.CIF_RUPIAH', 'LIKE', "%$search%")
                    ->orWhere('iplb_db_prod.plb_kemasan.WAKTU_GATE_OUT', 'LIKE', "%$search%");
            });
        })
            ->when($search_kode_dokumen_pabean, function ($query) use ($search_kode_dokumen_pabean) {
                $query->where('iplb_db_prod.plb_header.KODE_DOKUMEN_PABEAN', 'LIKE', "%$search_kode_dokumen_pabean%");
            })
            ->when($search_nomor_aju, function ($query) use ($search_nomor_aju) {
                $query->where('iplb_db_prod.plb_header.NOMOR_AJU', 'LIKE', "%$search_nomor_aju%");
            })
            ->when($search_tanggal_aju, function ($query) use ($search_tanggal_aju) {
                $query->where('iplb_db_prod.plb_header.TANGGAL_AJU', 'LIKE', "%$search_tanggal_aju%");
            })
            ->when($search_nomor_daftar, function ($query) use ($search_nomor_daftar) {
                $query->where('iplb_db_prod.plb_header.NOMOR_DAFTAR', 'LIKE', "%$search_nomor_daftar%");
            })
            ->when($search_tanggal_daftar, function ($query) use ($search_tanggal_daftar) {
                $query->where('iplb_db_prod.plb_header.TANGGAL_DAFTAR', 'LIKE', "%$search_tanggal_daftar%");
            })
            ->when($search_tanggal_pengeluaran, function ($query) use ($search_tanggal_pengeluaran) {
                $query->where('iplb_db_prod.plb_kemasan.WAKTU_GATE_OUT', 'LIKE', "%$search_tanggal_pengeluaran%");
            })
            ->when($search_nama_pemilik, function ($query) use ($search_nama_pemilik) {
                $query->where('iplb_db_prod.plb_header.NAMA_PEMILIK', 'LIKE', "%$search_nama_pemilik%");
            })
            ->when($search_kode_barang, function ($query) use ($search_kode_barang) {
                $query->where('iplb_db_prod.plb_barang.KODE_BARANG', 'LIKE', "%$search_kode_barang%");
            })
            ->when($search_kode_hs, function ($query) use ($search_kode_hs) {
                $query->where('iplb_db_prod.plb_barang.POS_TARIF', 'LIKE', "%$search_kode_hs%");
            })
            ->when($search_nama_barang, function ($query) use ($search_nama_barang) {
                $query->where('iplb_db_prod.plb_barang.URAIAN', 'LIKE', "%$search_nama_barang%");
            })
            ->when($search_jumlah_satuan, function ($query) use ($search_jumlah_satuan) {
                $query->where('iplb_db_prod.plb_barang.JUMLAH_SATUAN', 'LIKE', "%$search_jumlah_satuan%");
            })
            ->when($search_kode_satuan, function ($query) use ($search_kode_satuan) {
                $query->where('iplb_db_prod.plb_barang.KODE_SATUAN', 'LIKE', "%$search_kode_satuan%");
            })
            ->when($search_cif_rupiah, function ($query) use ($search_cif_rupiah) {
                $query->where('iplb_db_prod.plb_barang.CIF_RUPIAH', 'LIKE', "%$search_cif_rupiah%");
            })
            ->when($filter_kode_dokumen_pabean, function ($query) use ($filter_kode_dokumen_pabean) {
                $query->whereIn('iplb_db_prod.plb_header.KODE_DOKUMEN_PABEAN', $filter_kode_dokumen_pabean);
            })
            ->when($filter_nomor_aju, function ($query) use ($filter_nomor_aju) {
                $query->where('iplb_db_prod.plb_header.NOMOR_AJU', 'LIKE', "%$filter_nomor_aju%");
            })
            ->when($filter_start_date, function ($query) use ($filter_start_date) {
                $query->whereDate('iplb_db_prod.plb_header.TANGGAL_DAFTAR', '>=', $filter_start_date);
            })
            ->when($filter_end_date, function ($query) use ($filter_end_date) {
                $query->whereDate('iplb_db_prod.plb_header.TANGGAL_DAFTAR', '<=', $filter_end_date);
            })
            ->when(($order && $by), function ($query) use ($order, $by) {
                $query->orderBy($order, $by);
            })
            ->paginate($paginate);

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