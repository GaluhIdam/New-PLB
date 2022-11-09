<?php

namespace App\Http\Controllers\API\Costums;

use Illuminate\Http\Request;
use App\Models\Costums\Outbound;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Costums\OutboundExport;

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

        // Filter
        $filter_start_date = $request->get('filter_start_date');
        $filter_end_date = $request->get('filter_end_date');
        $filter_kode_dokumen_pabean = $request->get('filter_kode_dokumen_pabean');

        // Sort
        if ($request->get('order') && $request->get('by')) {
            $order = $request->get('order');
            $by = $request->get('by');
        } else {
            $order = 'TANGGAL_DAFTAR';
            $by = 'desc';
        }
        if ($request->get('paginate')) {
            $paginate = $request->get('paginate');
        } else {
            $paginate = 10;
        }

        // Query
        $outbounds = Outbound::when($search, function ($query) use ($search) {
            $query->where(function ($sub_query) use ($search) {
                $sub_query->where('KODE_DOKUMEN_PABEAN', 'LIKE', "%$search%")
                    ->orWhere('NOMOR_AJU', 'LIKE', "%$search%")
                    ->orWhere('TANGGAL_AJU', 'LIKE', "%$search%")
                    ->orWhere('NOMOR_DAFTAR', 'LIKE', "%$search%")
                    ->orWhere('TANGGAL_DAFTAR', 'LIKE', "%$search%")
                    ->orWhere('NAMA_PEMILIK', 'LIKE', "%$search%")
                    ->orWhere('KODE_BARANG', 'LIKE', "%$search%")
                    ->orWhere('POS_TARIF', 'LIKE', "%$search%")
                    ->orWhere('URAIAN', 'LIKE', "%$search%")
                    ->orWhere('JUMLAH_SATUAN', 'LIKE', "%$search%")
                    ->orWhere('KODE_SATUAN', 'LIKE', "%$search%")
                    ->orWhere('HARGA_PENYERAHAN', 'LIKE', "%$search%")
                    ->orWhere('CIF', 'LIKE', "%$search%")
                    ->orWhere('CIF_RUPIAH', 'LIKE', "%$search%")
                    ->orWhere('WAKTU_GATE_OUT', 'LIKE', "%$search%");
            });
        })
            ->when($search_kode_dokumen_pabean, function ($query) use ($search_kode_dokumen_pabean) {
                $query->where('KODE_DOKUMEN_PABEAN', 'LIKE', "%$search_kode_dokumen_pabean%");
            })
            ->when($search_nomor_aju, function ($query) use ($search_nomor_aju) {
                $query->where('NOMOR_AJU', 'LIKE', "%$search_nomor_aju%");
            })
            ->when($search_tanggal_aju, function ($query) use ($search_tanggal_aju) {
                $query->where('TANGGAL_AJU', 'LIKE', "%$search_tanggal_aju%");
            })
            ->when($search_nomor_daftar, function ($query) use ($search_nomor_daftar) {
                $query->where('NOMOR_DAFTAR', 'LIKE', "%$search_nomor_daftar%");
            })
            ->when($search_tanggal_daftar, function ($query) use ($search_tanggal_daftar) {
                $query->where('TANGGAL_DAFTAR', 'LIKE', "%$search_tanggal_daftar%");
            })
            ->when($search_tanggal_pengeluaran, function ($query) use ($search_tanggal_pengeluaran) {
                $query->where('WAKTU_GATE_OUT', 'LIKE', "%$search_tanggal_pengeluaran%");
            })
            ->when($search_nama_pemilik, function ($query) use ($search_nama_pemilik) {
                $query->where('NAMA_PEMILIK', 'LIKE', "%$search_nama_pemilik%");
            })
            ->when($search_kode_barang, function ($query) use ($search_kode_barang) {
                $query->where('KODE_BARANG', 'LIKE', "%$search_kode_barang%");
            })
            ->when($search_kode_hs, function ($query) use ($search_kode_hs) {
                $query->where('POS_TARIF', 'LIKE', "%$search_kode_hs%");
            })
            ->when($search_nama_barang, function ($query) use ($search_nama_barang) {
                $query->where('URAIAN', 'LIKE', "%$search_nama_barang%");
            })
            ->when($search_jumlah_satuan, function ($query) use ($search_jumlah_satuan) {
                $query->where('JUMLAH_SATUAN', 'LIKE', "%$search_jumlah_satuan%");
            })
            ->when($search_kode_satuan, function ($query) use ($search_kode_satuan) {
                $query->where('KODE_SATUAN', 'LIKE', "%$search_kode_satuan%");
            })
            ->when($filter_kode_dokumen_pabean, function ($query) use ($filter_kode_dokumen_pabean) {
                $query->whereIn('KODE_DOKUMEN_PABEAN', $filter_kode_dokumen_pabean);
            })
            ->when($filter_start_date, function ($query) use ($filter_start_date) {
                $query->whereDate('TANGGAL_DAFTAR', '>=', $filter_start_date);
            })
            ->when($filter_end_date, function ($query) use ($filter_end_date) {
                $query->whereDate('TANGGAL_DAFTAR', '<=', $filter_end_date);
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

    public function exportCsv()
    {
        return Excel::download(new OutboundExport, 'kepabeanan-outbound.csv');
    }

    public function exportExcel()
    {
        return Excel::download(new OutboundExport, 'kepabeanan-outbound.xlsx');
    }
}