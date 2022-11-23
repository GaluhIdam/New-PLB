<?php

namespace App\Http\Controllers\API\Costums;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Costums\Outbound;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Costums\OutboundExport;

class OutboundController extends Controller
{
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
        $search_nama_penerima = $request->get('search_nama_penerima');
        $search_kode_barang = $request->get('search_kode_barang');
        $search_kode_hs = $request->get('search_kode_hs');
        $search_nama_barang = $request->get('search_nama_barang');
        $search_jumlah_satuan = $request->get('search_jumlah_satuan');
        $search_kode_satuan = $request->get('search_kode_satuan');
        $search_nilai_barang = $request->get('search_nilai_barang'); // Harga Penyerahan / CIF / CIF_RUPIAH
        $search_kode_valuta = $request->get('search_kode_valuta');

        // Filter
        $filter_start_date = $request->get('filter_start_date');
        if ($filter_start_date) {
            $filter_start_date = Carbon::parse($filter_start_date)->subDays();
        }
        $filter_end_date = $request->get('filter_end_date');
        $filter_kode_dokumen_pabean = $request->get('filter_kode_dokumen_pabean');

        // Sort, By, and Pagination
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
                    ->orWhere('KODE_VALUTA', 'LIKE', "%$search%")
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
                $query->where('WAKTU_GATE_OUT', 'LIKE', "%$search_tanggal_pengeluaran%")
                    ->orWhere('TANGGAL_DAFTAR', 'LIKE', "%$search_tanggal_pengeluaran%");
            })
            ->when($search_nama_pemilik, function ($query) use ($search_nama_pemilik) {
                $query->where('NAMA_PEMILIK', 'LIKE', "%$search_nama_pemilik%")
                    ->orWhere('NAMA_PENERIMA_BARANG', 'LIKE', "%$search_nama_pemilik%");
            })
            ->when($search_nama_penerima, function ($query) use ($search_nama_penerima) {
                $query->where('NAMA_PENGIRIM', 'LIKE', "%$search_nama_penerima%");
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
            ->when($search_nilai_barang, function ($query) use ($search_nilai_barang) {
                $query->where('HARGA_PENYERAHAN', 'LIKE', "%$search_nilai_barang%")
                    ->orWhere('CIF', 'LIKE', "%$search_nilai_barang%")
                    ->orWhere('CIF_RUPIAH', 'LIKE', "%$search_nilai_barang%");
            })
            ->when($search_kode_valuta, function ($query) use ($search_kode_valuta) {
                $query->where('KODE_VALUTA', 'LIKE', "%$search_kode_valuta%");
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
            })->paginate($paginate);

        $query_string = [
            'search' => $search,
            'order' => $order,
            'by' => $by,
            'paginate' => $paginate,
        ];

        $outbounds->appends($query_string);
        return $outbounds;
    }

    public function exportCsv(Request $request)
    {
        $search = $request->get('search');
        $search_kode_dokumen_pabean = $request->get('search_kode_dokumen_pabean');
        $search_nomor_aju = $request->get('search_nomor_aju');
        $search_tanggal_aju = $request->get('search_tanggal_aju');
        $search_nomor_daftar = $request->get('search_nomor_daftar');
        $search_tanggal_daftar = $request->get('search_tanggal_daftar');
        $search_tanggal_pengeluaran = $request->get('search_tanggal_pengeluaran');
        $search_nama_pemilik = $request->get('search_nama_pemilik');
        $search_nama_penerima = $request->get('search_nama_penerima');
        $search_kode_barang = $request->get('search_kode_barang');
        $search_kode_hs = $request->get('search_kode_hs');
        $search_nama_barang = $request->get('search_nama_barang');
        $search_jumlah_satuan = $request->get('search_jumlah_satuan');
        $search_kode_satuan = $request->get('search_kode_satuan');
        $search_nilai_barang = $request->get('search_nilai_barang'); // Harga Penyerahan / CIF / CIF_RUPIAH
        $search_kode_valuta = $request->get('search_kode_valuta');

        // Filter
        $filter_start_date = $request->get('filter_start_date');
        if ($filter_start_date) {
            $filter_start_date = Carbon::parse($filter_start_date)->subDays();
        }
        $filter_end_date = $request->get('filter_end_date');
        $filter_kode_dokumen_pabean = $request->get('filter_kode_dokumen_pabean');

        // Sort, By, and Pagination
        if ($request->get('order') && $request->get('by')) {
            $order = $request->get('order');
            $by = $request->get('by');
        } else {
            $order = 'TANGGAL_DAFTAR';
            $by = 'desc';
        }

        return Excel::download(new OutboundExport(
            $search,
            $search_kode_dokumen_pabean,
            $search_nomor_aju,
            $search_tanggal_aju,
            $search_nomor_daftar,
            $search_tanggal_daftar,
            $search_tanggal_pengeluaran,
            $search_nama_pemilik,
            $search_nama_penerima,
            $search_kode_barang,
            $search_kode_hs,
            $search_nama_barang,
            $search_jumlah_satuan,
            $search_kode_satuan,
            $search_nilai_barang,
            $search_kode_valuta,
            $filter_start_date,
            $filter_end_date,
            $filter_kode_dokumen_pabean,
            $order,
            $by
        ), 'outbound.csv');
    }

    public function exportExcel(Request $request)
    {
        $search = $request->get('search');
        $search_kode_dokumen_pabean = $request->get('search_kode_dokumen_pabean');
        $search_nomor_aju = $request->get('search_nomor_aju');
        $search_tanggal_aju = $request->get('search_tanggal_aju');
        $search_nomor_daftar = $request->get('search_nomor_daftar');
        $search_tanggal_daftar = $request->get('search_tanggal_daftar');
        $search_tanggal_pengeluaran = $request->get('search_tanggal_pengeluaran');
        $search_nama_pemilik = $request->get('search_nama_pemilik');
        $search_nama_penerima = $request->get('search_nama_penerima');
        $search_kode_barang = $request->get('search_kode_barang');
        $search_kode_hs = $request->get('search_kode_hs');
        $search_nama_barang = $request->get('search_nama_barang');
        $search_jumlah_satuan = $request->get('search_jumlah_satuan');
        $search_kode_satuan = $request->get('search_kode_satuan');
        $search_nilai_barang = $request->get('search_nilai_barang'); // Harga Penyerahan / CIF / CIF_RUPIAH
        $search_kode_valuta = $request->get('search_kode_valuta');

        // Filter
        $filter_start_date = $request->get('filter_start_date');
        if ($filter_start_date) {
            $filter_start_date = Carbon::parse($filter_start_date)->subDays();
        }
        $filter_end_date = $request->get('filter_end_date');
        $filter_kode_dokumen_pabean = $request->get('filter_kode_dokumen_pabean');

        // Sort, By, and Pagination
        if ($request->get('order') && $request->get('by')) {
            $order = $request->get('order');
            $by = $request->get('by');
        } else {
            $order = 'TANGGAL_DAFTAR';
            $by = 'desc';
        }
        return Excel::download(new OutboundExport(
            $search,
            $search_kode_dokumen_pabean,
            $search_nomor_aju,
            $search_tanggal_aju,
            $search_nomor_daftar,
            $search_tanggal_daftar,
            $search_tanggal_pengeluaran,
            $search_nama_pemilik,
            $search_nama_penerima,
            $search_kode_barang,
            $search_kode_hs,
            $search_nama_barang,
            $search_jumlah_satuan,
            $search_kode_satuan,
            $search_nilai_barang,
            $search_kode_valuta,
            $filter_start_date,
            $filter_end_date,
            $filter_kode_dokumen_pabean,
            $order,
            $by
        ), 'kepabeanan-outbound.xlsx');
    }
}