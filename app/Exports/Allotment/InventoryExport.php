<?php

namespace App\Exports\Allotment;

use App\Models\Costums\Inbound;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class InventoryExport implements FromView, WithColumnFormatting, WithMapping
{
    public $search;
    public $search_kode_dokumen_pabean;
    public $search_part_number;
    public $search_plant_origin;
    public $search_plant_destination;
    public $search_quantity;
    public $filter_plant;
    public $order;
    public $by;

    public function __construct(
        $search,
        $search_part_number,
        $search_plant_origin,
        $search_plant_destination,
        $search_quantity,
        $filter_plant,
        $order,
        $by
    ) {
        $this->search = $search;
        $this->search_part_number = $search_part_number;
        $this->search_plant_origin = $search_plant_origin;
        $this->search_plant_destination = $search_plant_destination;
        $this->search_quantity = $search_quantity;
        $this->filter_plant = $filter_plant;
        $this->order = $order;
        $this->by = $by;
    }

    public function view(): View
    {
        $search = $this->search;
        $search_part_number = $this->search_part_number;
        $search_plant_origin = $this->search_plant_origin;
        $search_plant_destination = $this->search_plant_destination;
        $search_quantity = $this->search_quantity;
        $filter_plant = $this->filter_plant;
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