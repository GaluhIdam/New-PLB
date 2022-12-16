<?php

namespace App\Exports\Reports;

use App\Models\Reports\Mutation;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class MutationExport implements FromView, WithColumnFormatting, WithMapping
{
    use Exportable;

    public $search;
    public $search_kode_barang;
    public $search_nama_barang;
    public $search_kode_satuan;
    public $search_saldo_awal;
    public $search_saldo_akhir;
    public $search_saldo_penyesuaian;
    public $search_bc16;
    public $search_bc27_in;
    public $search_bc27_out;
    public $search_bc40;
    public $search_bc41;
    public $search_bc28;
    public $search_bc30;

    public function __construct(
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
    ) {
        $this->search = $search;
        $this->search_kode_barang = $search_kode_barang;
        $this->search_nama_barang = $search_nama_barang;
        $this->search_kode_satuan = $search_kode_satuan;
        $this->search_saldo_awal = $search_saldo_awal;
        $this->search_saldo_akhir = $search_saldo_akhir;
        $this->search_saldo_penyesuaian = $search_saldo_penyesuaian;
        $this->search_bc16 = $search_bc16;
        $this->search_bc27_in = $search_bc27_in;
        $this->search_bc27_out = $search_bc27_out;
        $this->search_bc40 = $search_bc40;
        $this->search_bc41 = $search_bc41;
        $this->search_bc28 = $search_bc28;
        $this->search_bc30 = $search_bc30;
        $this->search_tanggal_saldo = $search_tanggal_saldo;
        $this->filter_start_date = $filter_start_date;
        $this->filter_end_date = $filter_end_date;
        $this->order = $order;
        $this->by = $by;
    }


    public function view(): View
    {
        $search = $this->search;
        $search_kode_barang = $this->search_kode_barang;
        $search_nama_barang = $this->search_nama_barang;
        $search_kode_satuan = $this->search_kode_satuan;
        $search_saldo_awal = $this->search_saldo_awal;
        $search_saldo_akhir = $this->search_saldo_akhir;
        $search_saldo_penyesuaian = $this->search_saldo_penyesuaian;
        $search_bc16 = $this->search_bc16;
        $search_bc27_in = $this->search_bc27_in;
        $search_bc27_out = $this->search_bc27_out;
        $search_bc40 = $this->search_bc40;
        $search_bc41 = $this->search_bc41;
        $search_bc28 = $this->search_bc28;
        $search_bc30 = $this->search_bc30;
        $search_tanggal_saldo = $this->search_tanggal_saldo;
        $filter_start_date = $this->filter_start_date;
        $filter_end_date = $this->filter_end_date;
        $order = $this->order;
        $by = $this->by;


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
        })->get();

        return view('exports.reports.mutation', compact(['reports', 'filter_start_date', 'filter_end_date']));
    }

    public function map($reports): array
    {
        return [
            $reports->KODE_BARANG,
            $reports->URAIAN,
            $reports->KODE_SATUAN,
            $reports->TANGGAL_AJU,
            $reports->SALDO_AWAL,
            $reports->SALDO_AKHIR,
            $reports->SALDO_PENYESUAIAN,
            $reports->BC16,
            $reports->BC27IN,
            $reports->BC27OUT,
            $reports->BC40,
            $reports->BC41,
            $reports->BC28,
            $reports->BC30,
            $reports->TANGGAL_SALDO,
        ];
    }
    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_TEXT,
            'E' => NumberFormat::FORMAT_TEXT,
            'F' => NumberFormat::FORMAT_TEXT,
            'G' => NumberFormat::FORMAT_TEXT,
            'H' => NumberFormat::FORMAT_TEXT,
            'I' => NumberFormat::FORMAT_TEXT,
            'J' => NumberFormat::FORMAT_TEXT,
            'K' => NumberFormat::FORMAT_TEXT,
            'L' => NumberFormat::FORMAT_TEXT,
            'M' => NumberFormat::FORMAT_TEXT,
            'N' => NumberFormat::FORMAT_TEXT,
            'O' => NumberFormat::FORMAT_TEXT,
        ];
    }
}
