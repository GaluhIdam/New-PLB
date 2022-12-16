<?php

namespace App\Http\Controllers\API\Reports;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Reports\Mutation;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Reports\MutationExport;

class MutationReportController extends Controller
{
    use \App\Http\Traits\ActivityHistoryTrait;
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        $this->recordActivity('Akses Laporan Mutasi');
        // Search Query
        $search = $request->get('search');
        $search_kode_barang = $request->get('search_kode_barang');
        $search_nama_barang = $request->get('search_nama_barang');
        $search_kode_satuan = $request->get('search_kode_satuan');
        $search_saldo_awal = $request->get('search_saldo_awal');
        $search_saldo_akhir = $request->get('search_saldo_akhir');
        $search_saldo_penyesuaian = $request->get('search_saldo_penyesuaian');
        $search_bc16 = $request->get('search_bc16');
        $search_bc27_in = $request->get('search_bc27_in');
        $search_bc27_out = $request->get('search_bc27_out');
        $search_bc40 = $request->get('search_bc40');
        $search_bc41 = $request->get('search_bc41');
        $search_bc28 = $request->get('search_bc28');
        $search_bc30 = $request->get('search_bc30');
        $search_tanggal_saldo = $request->get('search_tanggal_saldo');
        // Filter Query
        $filter_start_date = $request->get('filter_start_date'); // Untuk Filter Start Date
        if ($filter_start_date) {
            $filter_start_date = Carbon::parse($filter_start_date)->subDays(1);
        }
        $filter_end_date = $request->get('filter_end_date');

        // Sort, By, and Pagination
        if ($request->get('order') && $request->get('by')) {
            $order = $request->get('order');
            $by = $request->get('by');
        } else {
            $order = 'SALDO_AKHIR';
            $by = 'desc';
        }
        if ($request->get('paginate')) {
            $paginate = $request->get('paginate');
        } else {
            $paginate = 10;
        }

        // Start Query
        $reports = Mutation::when($search, function ($query) use ($search) {
            $query->where(function ($sub_query) use ($search) {
                $sub_query->where('KODE_BARANG', 'LIKE', "%$search%")
                    ->orWhere('URAIAN', 'LIKE', "%$search%")
                    ->orWhere('KODE_SATUAN', 'LIKE', "%$search%")
                    ->orWhere('TANGGAL_AJU', 'LIKE', "%$search%")
                    ->orWhere('SALDO_AWAL', 'LIKE', "%$search%")
                    ->orWhere('SALDO_AKHIR', 'LIKE', "%$search%")
                    ->orWhere('SALDO_PENYESUAIAN', 'LIKE', "%$search%")
                    ->orWhere('BC16', 'LIKE', "%$search%")
                    ->orWhere('BC27IN', 'LIKE', "%$search%")
                    ->orWhere('BC27', 'LIKE', "%$search%")
                    ->orWhere('BC40', 'LIKE', "%$search%")
                    ->orWhere('BC41', 'LIKE', "%$search%")
                    ->orWhere('BC28', 'LIKE', "%$search%")
                    ->orWhere('BC30', 'LIKE', "%$search%")
                    ->orWhere('TANGGAL_SALDO', 'LIKE', "%$search%");
            });
        })->when($search_kode_barang, function ($query) use ($search_kode_barang) {
            $query->where('KODE_BARANG', 'LIKE', "%$search_kode_barang%");
        })->when($search_nama_barang, function ($query) use ($search_nama_barang) {
            $query->where('URAIAN', 'LIKE', "%$search_nama_barang%");
        })->when($search_kode_satuan, function ($query) use ($search_kode_satuan) {
            $query->where('KODE_SATUAN', 'LIKE', "%$search_kode_satuan%");
        })->when($search_saldo_awal, function ($query) use ($search_saldo_awal) {
            $query->where('SALDO_AWAL', 'LIKE', "%$search_saldo_awal%");
        })->when($search_saldo_akhir, function ($query) use ($search_saldo_akhir) {
            $query->where('SALDO_AKHIR', 'LIKE', "%$search_saldo_akhir%");
        })->when($search_saldo_penyesuaian, function ($query) use ($search_saldo_penyesuaian) {
            $query->where('SALDO_PENYESUAIAN', 'LIKE', "%$search_saldo_penyesuaian%");
        })->when($search_bc16, function ($query) use ($search_bc16) {
            $query->where('BC16', 'LIKE', "%$search_bc16%");
        })->when($search_bc27_in, function ($query) use ($search_bc27_in) {
            $query->where('BC27IN', 'LIKE', "%$search_bc27_in%");
        })->when($search_bc27_out, function ($query) use ($search_bc27_out) {
            $query->where('BC27OUT', 'LIKE', "%$search_bc27_out%");
        })->when($search_bc40, function ($query) use ($search_bc40) {
            $query->where('BC40', 'LIKE', "%$search_bc40%");
        })->when($search_bc41, function ($query) use ($search_bc41) {
            $query->where('BC41', 'LIKE', "%$search_bc41%");
        })->when($search_bc28, function ($query) use ($search_bc28) {
            $query->where('BC28', 'LIKE', "%$search_bc28%");
        })->when($search_bc30, function ($query) use ($search_bc30) {
            $query->where('BC30', 'LIKE', "%$search_bc30%");
        })->when($search_tanggal_saldo, function ($query) use ($search_tanggal_saldo) {
            $query->whereDate('TANGGAL_SALDO', 'LIKE', "%$search_tanggal_saldo%");
        })->when($filter_start_date, function ($query) use ($filter_start_date) {
            $query->whereDate('TANGGAL_SALDO', '>', $filter_start_date);
        })->when($filter_end_date, function ($query) use ($filter_end_date) {
            $query->whereDate('TANGGAL_SALDO', '<=', $filter_end_date);
        })->when(($order && $by), function ($query) use ($order, $by) {
            $query->orderBy($order, $by);
        })->paginate($paginate);


        $result = [
            'search' => $search,
            'order' => $order,
            'by' => $by,
            'paginate' => $paginate,
        ];

        $reports->appends($result);
        return $reports;
    }

    public function exportCsv(Request $request)
    {
        $search = $request->get('search');
        $search_kode_barang = $request->get('search_kode_barang');
        $search_nama_barang = $request->get('search_nama_barang');
        $search_kode_satuan = $request->get('search_kode_satuan');
        $search_saldo_awal = $request->get('search_saldo_awal');
        $search_saldo_akhir = $request->get('search_saldo_akhir');
        $search_saldo_penyesuaian = $request->get('search_saldo_penyesuaian');
        $search_bc16 = $request->get('search_bc16');
        $search_bc27_in = $request->get('search_bc27_in');
        $search_bc27_out = $request->get('search_bc27_out');
        $search_bc40 = $request->get('search_bc40');
        $search_bc41 = $request->get('search_bc41');
        $search_bc28 = $request->get('search_bc28');
        $search_bc30 = $request->get('search_bc30');
        $search_tanggal_saldo = $request->get('search_tanggal_saldo');
        // Filter Query
        $filter_start_date = $request->get('filter_start_date'); // Untuk Filter Start Date
        if ($filter_start_date) {
            $filter_start_date = Carbon::parse($filter_start_date)->subDays(1);
        }
        $filter_end_date = $request->get('filter_end_date');

        // Sort, By, and Pagination
        if ($request->get('order') && $request->get('by')) {
            $order = $request->get('order');
            $by = $request->get('by');
        } else {
            $order = 'SALDO_AKHIR';
            $by = 'desc';
        }

        return Excel::download(new MutationExport(
            $search,
            $search_kode_barang,
            $search_nama_barang,
            $search_kode_satuan,
            $search_saldo_awal,
            $search_saldo_akhir,
            $search_saldo_penyesuaian,
            $search_bc16,
            $search_bc27_in,
            $search_bc27_out,
            $search_bc40,
            $search_bc41,
            $search_bc28,
            $search_bc30,
            $search_tanggal_saldo,
            $filter_start_date,
            $filter_end_date,
            $order,
            $by
        ), 'report-mutation.csv');
    }

    public function exportExcel(Request $request)
    {
        $search = $request->get('search');
        $search_kode_barang = $request->get('search_kode_barang');
        $search_nama_barang = $request->get('search_nama_barang');
        $search_kode_satuan = $request->get('search_kode_satuan');
        $search_saldo_awal = $request->get('search_saldo_awal');
        $search_saldo_akhir = $request->get('search_saldo_akhir');
        $search_saldo_penyesuaian = $request->get('search_saldo_penyesuaian');
        $search_bc16 = $request->get('search_bc16');
        $search_bc27_in = $request->get('search_bc27_in');
        $search_bc27_out = $request->get('search_bc27_out');
        $search_bc40 = $request->get('search_bc40');
        $search_bc41 = $request->get('search_bc41');
        $search_bc28 = $request->get('search_bc28');
        $search_bc30 = $request->get('search_bc30');
        $search_tanggal_saldo = $request->get('search_tanggal_saldo');
        // Filter Query
        $filter_start_date = $request->get('filter_start_date'); // Untuk Filter Start Date
        if ($filter_start_date) {
            $filter_start_date = Carbon::parse($filter_start_date)->subDays(1);
        }
        $filter_end_date = $request->get('filter_end_date');

        // Sort, By, and Pagination
        if ($request->get('order') && $request->get('by')) {
            $order = $request->get('order');
            $by = $request->get('by');
        } else {
            $order = 'SALDO_AKHIR';
            $by = 'desc';
        }

        return Excel::download(new MutationExport(
            $search,
            $search_kode_barang,
            $search_nama_barang,
            $search_kode_satuan,
            $search_saldo_awal,
            $search_saldo_akhir,
            $search_saldo_penyesuaian,
            $search_bc16,
            $search_bc27_in,
            $search_bc27_out,
            $search_bc40,
            $search_bc41,
            $search_bc28,
            $search_bc30,
            $search_tanggal_saldo,
            $filter_start_date,
            $filter_end_date,
            $order,
            $by
        ), 'report-mutation.xlsx');
    }
}
