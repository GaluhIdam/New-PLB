<?php

namespace App\Http\Controllers\API\Costums;

use App\Http\Controllers\Controller;
use App\Models\Costums\Inbound;
use Illuminate\Http\Request;

class InboundController extends Controller
{
    /* 
    List Data yang dimunculin : 
    1. Kode Dukunen Pabean [$query->KODE_DOKUMEN_PABEAN]
    2. Nomor AJU [$query->NOMOR_AJU]
    3. Tanggal AJU [$query->TANGGAL_AJU]
    4. Nomor DAFTAR [$query->NOMOR_DAFTAR]
    5. Tanggal DAFTAR [$query->TANGGAL_DAFTAR]
    6. Waktu Gate In [$query->WAKTU_GATE_IN]
    7. Waktu Gate Out [$query->WAKTU_GATE_OUT]
    8. Nama Pengirim [$query->NAMA_PENGIRIM]
    9. Nama Pemilik [$query->NAMA_PEMILIK]
    10. Kode Barang [$query->KODE_BARANG]
    11. Kode HS [$query->POS_TARIF]
    12. Uraian [$query->URAIAN]
    13. Jumlah Satuan [$query->JUMLAH_SATUAN]
    14. Kode Satuan [$query->KODE_SATUAN]
    15. Harga Penyerahan [$query->HARGA_PENYERAHAN]
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
        $search_waktu_gate_in = $request->get('search_waktu_gate_in');
        $search_waktu_gate_out = $request->get('search_waktu_gate_out');
        $search_nama_pengirim = $request->get('search_nama_pengirim');
        $search_nama_pemilik = $request->get('search_nama_pemilik');
        $search_kode_barang = $request->get('search_kode_barang');
        $search_pos_tarif = $request->get('search_pos_tarif');
        $search_uraian = $request->get('search_uraian');
        $search_jumlah_satuan = $request->get('search_jumlah_satuan');
        $search_kode_satuan = $request->get('search_kode_satuan');
        $search_harga_penyerahan = $request->get('search_harga_penyerahan');

        $filter_start_date = $request->get('filter_start_date');
        $filter_end_date = $request->get('filter_end_date');
        $filter_kode_dokumen_pabean = $request->get('filter_kode_dokumen_pabean');
        $filter_nomor_aju = $request->get('filter_nomor_aju');

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


        $inbounds = Inbound::newInbound()->when($search, function ($query) use ($search) {
            $query->where(function ($sub_query) use ($search) {
                $sub_query->where('plb_db_prod.tpb_header.KODE_DOKUMEN_PABEAN', 'LIKE', "%$search%")
                    ->orWhere('plb_db_prod.tpb_header.NOMOR_AJU', 'LIKE', "%$search%")
                    ->orWhere('plb_db_prod.tpb_header.TANGGAL_AJU', 'LIKE', "%$search%")
                    ->orWhere('plb_db_prod.tpb_header.NOMOR_DAFTAR', 'LIKE', "%$search%")
                    ->orWhere('plb_db_prod.tpb_header.TANGGAL_DAFTAR', 'LIKE', "%$search%")
                    ->orWhere('plb_db_prod.tpb_header.WAKTU_GATE_IN', 'LIKE', "%$search%")
                    ->orWhere('plb_db_prod.tpb_header.WAKTU_GATE_OUT', 'LIKE', "%$search%")
                    ->orWhere('plb_db_prod.tpb_header.NAMA_PENGIRIM', 'LIKE', "%$search%")
                    ->orWhere('plb_db_prod.tpb_header.NAMA_PEMILIK', 'LIKE', "%$search%")
                    ->orWhere('plb_db_prod.tpb_header.KODE_BARANG', 'LIKE', "%$search%")
                    ->orWhere('plb_db_prod.tpb_header.POS_TARIF', 'LIKE', "%$search%")
                    ->orWhere('plb_db_prod.tpb_header.URAIAN', 'LIKE', "%$search%")
                    ->orWhere('plb_db_prod.tpb_header.JUMLAH_SATUAN', 'LIKE', "%$search%")
                    ->orWhere('plb_db_prod.tpb_header.KODE_SATUAN', 'LIKE', "%$search%")
                    ->orWhere('plb_db_prod.tpb_header.HARGA_PENYERAHAN', 'LIKE', "%$search%");
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
            ->when($search_waktu_gate_in, function ($query) use ($search_waktu_gate_in) {
                $query->where('plb_db_prod.tpb_header.WAKTU_GATE_IN', 'LIKE', "%$search_waktu_gate_in%");
            })
            ->when($search_waktu_gate_out, function ($query) use ($search_waktu_gate_out) {
                $query->where('plb_db_prod.tpb_header.WAKTU_GATE_OUT', 'LIKE', "%$search_waktu_gate_out%");
            })
            ->when($search_nama_pengirim, function ($query) use ($search_nama_pengirim) {
                $query->where('plb_db_prod.tpb_header.NAMA_PENGIRIM', 'LIKE', "%$search_nama_pengirim%");
            })
            ->when($search_nama_pemilik, function ($query) use ($search_nama_pemilik) {
                $query->where('plb_db_prod.tpb_header.NAMA_PEMILIK', 'LIKE', "%$search_nama_pemilik%");
            })
            ->when($search_kode_barang, function ($query) use ($search_kode_barang) {
                $query->where('plb_db_prod.tpb_header.KODE_BARANG', 'LIKE', "%$search_kode_barang%");
            })
            ->when($search_pos_tarif, function ($query) use ($search_pos_tarif) {
                $query->where('plb_db_prod.tpb_header.POS_TARIF', 'LIKE', "%$search_pos_tarif%");
            })
            ->when($search_uraian, function ($query) use ($search_uraian) {
                $query->where('plb_db_prod.tpb_header.URAIAN', 'LIKE', "%$search_uraian%");
            })
            ->when($search_jumlah_satuan, function ($query) use ($search_jumlah_satuan) {
                $query->where('plb_db_prod.tpb_header.JUMLAH_SATUAN', 'LIKE', "%$search_jumlah_satuan%");
            })
            ->when($search_kode_satuan, function ($query) use ($search_kode_satuan) {
                $query->where('plb_db_prod.tpb_header.KODE_SATUAN', 'LIKE', "%$search_kode_satuan%");
            })
            ->when($search_harga_penyerahan, function ($query) use ($search_harga_penyerahan) {
                $query->where('plb_db_prod.tpb_header.HARGA_PENYERAHAN', 'LIKE', "%$search_harga_penyerahan%");
            })
            ->when($filter_kode_dokumen_pabean, function ($query) use ($filter_kode_dokumen_pabean) {
                $query->where('plb_db_prod.tpb_header.KODE_DOKUMEN_PABEAN', 'LIKE', "%$filter_kode_dokumen_pabean%");
            })
            ->when($filter_nomor_aju, function ($query) use ($filter_nomor_aju) {
                $query->where('plb_db_prod.tpb_header.NOMOR_AJU', 'LIKE', "%$filter_nomor_aju%");
            })->when($filter_start_date, function ($query) use ($filter_start_date) {
                $query->whereDate('TANGGAL_DAFTAR', '>=', $filter_start_date);
            })->when($filter_end_date, function ($query) use ($filter_end_date) {
                $query->whereDate('TANGGAL_DAFTAR', '<=', $filter_end_date);
            })->when(($order && $by), function ($query) use ($order, $by) {
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