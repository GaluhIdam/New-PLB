<?php

namespace App\Http\Controllers\API\Costums;

use App\Http\Controllers\Controller;
use App\Models\Costums\Inbound;
use Illuminate\Http\Request;

class InboundController extends Controller
{
    /* 
    List Data yang dimunculin : 
    1. plb_db_prod.tpb_header.KODE_DOKUMEN_PABEAN [Kode Dokuemen Pabean]
    2. plb_db_prod.tpb_header.NOMOR_AJU [Nomor AJU]
    3. plb_db_prod.tpb_header.TANGGAL_AJU [Tanggal AJU]
    4. plb_db_prod.tpb_header.NOMOR_DAFTAR [Nomor DAFTAR]
    5. plb_db_prod.tpb_header.TANGGAL_DAFTAR [Tanggal DAFTAR]
    6. plb_db_prod.tpb_header.NAMA_PENGIRIM [Nama Pengirim]
    7. plb_db_prod.tpb_header.NAMA_PEMILIK [Nama Pemilik]
    8. plb_db_prod.tpb_barang.KODE_BARANG [Kode Barang]
    9. plb_db_prod.tpb_barang.POS_TARIF [Kode HS]
    10. plb_db_prod.tpb_barang.URAIAN [Nama Barang]
    11. plb_db_prod.tpb_barang.JUMLAH_SATUAN [Jumlah Satuan]
    12. plb_db_prod.tpb_barang.KODE_SATUAN [Kode Satuan]
    13. plb_db_prod.tpb_barang.HARGA_PENYERAHAN [Harga Penyerahan]
    14. plb_db_prod.tpb_barang.CIF [CIF]
    15. plb_db_prod.tpb_kemasan.WAKTU_GATE_IN [Tanggal Pemasukan]
    16. plb_db_prod.tpb_kemasan.WAKTU_GATE_OUT [Tanggal Pengeluaran]
    */
    use \App\Http\Traits\ActivityHistoryTrait;
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index(Request $request)
    {
        $this->recordActivity('Akses Dokumen Kepabeanan (Inbound)');
        //  Search
        $search = $request->get('search');
        $search_kode_dokumen_pabean = $request->get('search_kode_dokumen_pabean');
        $search_nomor_aju = $request->get('search_nomor_aju');
        $search_tanggal_aju = $request->get('search_tanggal_aju');
        $search_nomor_daftar = $request->get('search_nomor_daftar');
        $search_tanggal_daftar = $request->get('search_tanggal_daftar');
        $search_nama_pengirim = $request->get('search_nama_pengirim');
        $search_nama_pemilik = $request->get('search_nama_pemilik');
        $search_kode_barang = $request->get('search_kode_barang');
        $search_pos_tarif = $request->get('search_pos_tarif');
        $search_uraian = $request->get('search_uraian');
        $search_jumlah_satuan = $request->get('search_jumlah_satuan');
        $search_kode_satuan = $request->get('search_kode_satuan');
        $search_harga_penyerahan = $request->get('search_harga_penyerahan');
        $search_cif = $request->get('search_cif');
        $search_waktu_gate_in = $request->get('search_waktu_gate_in');
        $search_waktu_gate_out = $request->get('search_waktu_gate_out');

        $filter_start_date = $request->get('filter_start_date');
        $filter_end_date = $request->get('filter_end_date');
        $filter_kode_dokumen_pabean = $request->get('filter_kode_dokumen_pabean');
        $filter_nomor_aju = $request->get('filter_nomor_aju');

        if ($request->get('order') && $request->get('by')) {
            $order = $request->get('order');
            $by = $request->get('by');
        } else {
            $order = 'TANGGAL_AJU';
            $by = 'asc';
        }
        if ($request->get('paginate')) {
            $paginate = $request->get('paginate');
        } else {
            $paginate = 10;
        }


        $inbounds = Inbound::newInbound()->when($search, function ($query) use ($search) {
            $query->where(function ($sub_query) use ($search) {
                $sub_query->where('KODE_DOKUMEN_PABEAN', 'LIKE', "%$search%")
                    ->orWhere('NOMOR_AJU', 'LIKE', "%$search%")
                    ->orWhere('TANGGAL_AJU', 'LIKE', "%$search%")
                    ->orWhere('NOMOR_DAFTAR', 'LIKE', "%$search%")
                    ->orWhere('TANGGAL_DAFTAR', 'LIKE', "%$search%")
                    ->orWhere('NAMA_PENGIRIM', 'LIKE', "%$search%")
                    ->orWhere('NAMA_PEMILIK', 'LIKE', "%$search%")
                    ->orWhere('KODE_BARANG', 'LIKE', "%$search%")
                    ->orWhere('POS_TARIF', 'LIKE', "%$search%")
                    ->orWhere('URAIAN', 'LIKE', "%$search%")
                    ->orWhere('JUMLAH_SATUAN', 'LIKE', "%$search%")
                    ->orWhere('KODE_SATUAN', 'LIKE', "%$search%")
                    ->orWhere('HARGA_PENYERAHAN', 'LIKE', "%$search%")
                    ->orWhere('CIF', 'LIKE', "%$search%")
                    ->orWhere('WAKTU_GATE_IN', 'LIKE', "%$search%");
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
            ->when($search_nama_pengirim, function ($query) use ($search_nama_pengirim) {
                $query->where('NAMA_PENGIRIM', 'LIKE', "%$search_nama_pengirim%");
            })
            ->when($search_nama_pemilik, function ($query) use ($search_nama_pemilik) {
                $query->where('NAMA_PEMILIK', 'LIKE', "%$search_nama_pemilik%");
            })
            ->when($search_kode_barang, function ($query) use ($search_kode_barang) {
                $query->where('KODE_BARANG', 'LIKE', "%$search_kode_barang%");
            })
            ->when($search_pos_tarif, function ($query) use ($search_pos_tarif) {
                $query->where('POS_TARIF', 'LIKE', "%$search_pos_tarif%");
            })
            ->when($search_uraian, function ($query) use ($search_uraian) {
                $query->where('URAIAN', 'LIKE', "%$search_uraian%");
            })
            ->when($search_jumlah_satuan, function ($query) use ($search_jumlah_satuan) {
                $query->where('JUMLAH_SATUAN', 'LIKE', "%$search_jumlah_satuan%");
            })
            ->when($search_kode_satuan, function ($query) use ($search_kode_satuan) {
                $query->where('KODE_SATUAN', 'LIKE', "%$search_kode_satuan%");
            })
            ->when($search_harga_penyerahan, function ($query) use ($search_harga_penyerahan) {
                $query->where('HARGA_PENYERAHAN', 'LIKE', "%$search_harga_penyerahan%");
            })
            ->when($search_cif, function ($query) use ($search_cif) {
                $query->where('CIF', 'LIKE', "%$search_cif%");
            })
            ->when($search_waktu_gate_in, function ($query) use ($search_waktu_gate_in) {
                $query->where('WAKTU_GATE_IN', 'LIKE', "%$search_waktu_gate_in%");
            })
            ->when($filter_kode_dokumen_pabean, function ($query) use ($filter_kode_dokumen_pabean) {
                $query->whereIn('KODE_DOKUMEN_PABEAN', $filter_kode_dokumen_pabean);
            })
            ->when($filter_nomor_aju, function ($query) use ($filter_nomor_aju) {
                $query->where('NOMOR_AJU', 'LIKE', "%$filter_nomor_aju%");
            })
            ->when($filter_start_date, function ($query) use ($filter_start_date) {
                $query->whereDate('TANGGAL_AJU', '>=', $filter_start_date);
            })
            ->when($filter_end_date, function ($query) use ($filter_end_date) {
                $query->whereDate('TANGGAL_AJU', '<=', $filter_end_date);
            })
            ->when(($order && $by), function ($query) use ($order, $by) {
                $query->orderBy($order, $by);
            })->paginate($paginate);

        $query_string = [
            'search' => $search,
            'order' => $order,
            'by' => $by,
            'paginate' => $paginate,
        ];

        $inbounds->appends($query_string);

        return $inbounds;
    }
}