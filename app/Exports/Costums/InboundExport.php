<?php

namespace App\Exports\Costums;

use App\Models\Costums\Inbound;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class InboundExport implements FromView, WithColumnFormatting, WithMapping
{
    public $search;
    public $search_kode_dokumen_pabean;
    public $search_nomor_aju;
    public $search_tanggal_aju;
    public $search_nomor_daftar;
    public $search_tanggal_daftar;
    public $search_nama_pengirim;
    public $search_nama_pemilik;
    public $search_kode_barang;
    public $search_pos_tarif;
    public $search_uraian;
    public $search_jumlah_satuan;
    public $search_kode_satuan;
    public $search_nilai_barang;
    public $search_kode_valuta;
    public $search_tanggal_pemasukan;
    public $filter_start_date;
    public $filter_end_date;
    public $filter_kode_dokumen_pabean;
    public $order;
    public $by;

    public function __construct(
        $search,
        $search_kode_dokumen_pabean,
        $search_nomor_aju,
        $search_tanggal_aju,
        $search_nomor_daftar,
        $search_tanggal_daftar,
        $search_nama_pengirim,
        $search_nama_pemilik,
        $search_kode_barang,
        $search_pos_tarif,
        $search_uraian,
        $search_jumlah_satuan,
        $search_kode_satuan,
        $search_nilai_barang,
        $search_kode_valuta,
        $search_tanggal_pemasukan,
        $filter_start_date,
        $filter_end_date,
        $filter_kode_dokumen_pabean,
        $order,
        $by
    ) {
        $this->search = $search;
        $this->search_kode_dokumen_pabean = $search_kode_dokumen_pabean;
        $this->search_nomor_aju = $search_nomor_aju;
        $this->search_tanggal_aju = $search_tanggal_aju;
        $this->search_nomor_daftar = $search_nomor_daftar;
        $this->search_tanggal_daftar = $search_tanggal_daftar;
        $this->search_nama_pengirim = $search_nama_pengirim;
        $this->search_nama_pemilik = $search_nama_pemilik;
        $this->search_kode_barang = $search_kode_barang;
        $this->search_pos_tarif = $search_pos_tarif;
        $this->search_uraian = $search_uraian;
        $this->search_jumlah_satuan = $search_jumlah_satuan;
        $this->search_kode_satuan = $search_kode_satuan;
        $this->search_nilai_barang = $search_nilai_barang;
        $this->search_kode_valuta = $search_kode_valuta;
        $this->search_tanggal_pemasukan = $search_tanggal_pemasukan;
        $this->filter_start_date = $filter_start_date;
        $this->filter_end_date = $filter_end_date;
        $this->filter_kode_dokumen_pabean = $filter_kode_dokumen_pabean;
        $this->order = $order;
        $this->by = $by;
    }

    public function view(): View
    {
        $search = $this->search;
        $search_kode_dokumen_pabean = $this->search_kode_dokumen_pabean;
        $search_nomor_aju = $this->search_nomor_aju;
        $search_tanggal_aju = $this->search_tanggal_aju;
        $search_nomor_daftar = $this->search_nomor_daftar;
        $search_tanggal_daftar = $this->search_tanggal_daftar;
        $search_nama_pengirim = $this->search_nama_pengirim;
        $search_nama_pemilik = $this->search_nama_pemilik;
        $search_kode_barang = $this->search_kode_barang;
        $search_pos_tarif = $this->search_pos_tarif;
        $search_uraian = $this->search_uraian;
        $search_jumlah_satuan = $this->search_jumlah_satuan;
        $search_kode_satuan = $this->search_kode_satuan;
        $search_nilai_barang = $this->search_nilai_barang;
        $search_kode_valuta = $this->search_kode_valuta;
        $search_tanggal_pemasukan = $this->search_tanggal_pemasukan;
        $filter_start_date = $this->filter_start_date;
        $filter_end_date = $this->filter_end_date;
        $filter_kode_dokumen_pabean = $this->filter_kode_dokumen_pabean;
        $order = $this->order;
        $by = $this->by;

        $costums = Inbound::when($search, function ($query) use ($search) {
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
                    ->orWhere('KODE_VALUTA', 'LIKE', "%$search%")
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
            })->when($search_tanggal_pemasukan, function ($query) use ($search_tanggal_pemasukan) {
                $query->where('WAKTU_GATE_IN', 'LIKE', "%$search_tanggal_pemasukan%")
                    ->orWhere('TANGGAL_DAFTAR', 'LIKE', "%$search_tanggal_pemasukan%");
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
            ->when($search_nilai_barang, function ($query) use ($search_nilai_barang) {
                $query->where('HARGA_PENYERAHAN', 'LIKE', "%$search_nilai_barang%")
                    ->orWhere('CIF', 'LIKE', "%$search_nilai_barang%");
            })
            ->when($search_kode_valuta, function ($query) use ($search_kode_valuta) {
                $query->where('KODE_VALUTA', 'LIKE', "%$search_kode_valuta%");
            })
            ->when($filter_kode_dokumen_pabean, function ($query) use ($filter_kode_dokumen_pabean) {
                $query->whereIn('KODE_DOKUMEN_PABEAN', $filter_kode_dokumen_pabean);
            })
            ->when($filter_start_date, function ($query) use ($filter_start_date) {
                $query->whereDate('TANGGAL_DAFTAR', '>', $filter_start_date);
            })
            ->when($filter_end_date, function ($query) use ($filter_end_date) {
                $query->whereDate('TANGGAL_DAFTAR', '<=', $filter_end_date);
            })
            ->when(($order && $by), function ($query) use ($order, $by) {
                $query->orderBy($order, $by);
            })->get();

        return view('exports.costums.inbound', compact('costums'));
    }

    public function map($costums): array
    {
        return [
            Date::dateTimeToExcel(Inbound::find($costums->id)->TANGGAL_AJU),
            Date::dateTimeToExcel(Inbound::find($costums->id)->TANGGAL_DAFTAR),
            Date::dateTimeToExcel(Inbound::find($costums->id)->WAKTU_GATE_IN),
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'D' => NumberFormat::FORMAT_TEXT,
            'E' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'F' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}