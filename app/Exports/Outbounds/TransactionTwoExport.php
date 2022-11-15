<?php

namespace App\Exports\Outbounds;

use App\Models\Outbound\TransactionTwo;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class TransactionTwoExport implements FromView
{
    public $search;
    public $search_part_number;
    public $search_description;
    public $search_quantity;
    public $search_unit_measure;
    public $search_register_aircraft;
    public $search_customer;
    public $search_date_install;
    public $search_date_aircraft_in;
    public $search_date_aircraft_out;
    public $search_document_type;
    public $search_submission_number;
    public $search_submission_date;
    public $search_ttd_date;
    public $search_cif_idr;
    public $filter_start_date;
    public $filter_end_date;
    public $filter_customer;
    public $filter_part_number;
    public $filter_submission_number;
    public $filter_submission_date;
    public $filter_document_type;
    public $order;
    public $by;

    public function __construct(
        $search,
        $search_part_number,
        $search_description,
        $search_quantity,
        $search_unit_measure,
        $search_register_aircraft,
        $search_customer,
        $search_date_install,
        $search_date_aircraft_in,
        $search_date_aircraft_out,
        $search_document_type,
        $search_submission_number,
        $search_submission_date,
        $search_ttd_date,
        $search_cif_idr,
        $filter_start_date,
        $filter_end_date,
        $filter_customer,
        $filter_part_number,
        $filter_submission_number,
        $filter_submission_date,
        $filter_document_type,
        $order,
        $by
    ) {
        $this->search = $search;
        $this->search_part_number = $search_part_number;
        $this->search_description = $search_description;
        $this->search_quantity = $search_quantity;
        $this->search_unit_measure = $search_unit_measure;
        $this->search_register_aircraft = $search_register_aircraft;
        $this->search_customer = $search_customer;
        $this->search_date_install = $search_date_install;
        $this->search_date_aircraft_in = $search_date_aircraft_in;
        $this->search_date_aircraft_out = $search_date_aircraft_out;
        $this->search_document_type = $search_document_type;
        $this->search_submission_number = $search_submission_number;
        $this->search_submission_date = $search_submission_date;
        $this->search_ttd_date = $search_ttd_date;
        $this->search_cif_idr = $search_cif_idr;
        $this->filter_start_date = $filter_start_date;
        $this->filter_end_date = $filter_end_date;
        $this->filter_customer = $filter_customer;
        $this->filter_part_number = $filter_part_number;
        $this->filter_submission_number = $filter_submission_number;
        $this->filter_submission_date = $filter_submission_date;
        $this->filter_document_type = $filter_document_type;
        $this->order = $order;
        $this->by = $by;
    }

    public function view(): View
    {
        $search = $this->search;
        $search_part_number = $this->search_part_number;
        $search_description = $this->search_description;
        $search_quantity = $this->search_quantity;
        $search_unit_measure = $this->search_unit_measure;
        $search_register_aircraft = $this->search_register_aircraft;
        $search_customer = $this->search_customer;
        $search_date_install = $this->search_date_install;
        $search_date_aircraft_in = $this->search_date_aircraft_in;
        $search_date_aircraft_out = $this->search_date_aircraft_out;
        $search_document_type = $this->search_document_type;
        $search_submission_number = $this->search_submission_number;
        $search_submission_date = $this->search_submission_date;
        $search_ttd_date = $this->search_ttd_date;
        $search_cif_idr = $this->search_cif_idr;
        $filter_start_date = $this->filter_start_date;
        $filter_end_date = $this->filter_end_date;
        $filter_customer = $this->filter_customer;
        $filter_part_number = $this->filter_part_number;
        $filter_submission_number = $this->filter_submission_number;
        $filter_submission_date = $this->filter_submission_date;
        $filter_document_type = $this->filter_document_type;
        $order = $this->order;
        $by = $this->by;

        $outbounds = TransactionTwo::when($search, function ($query) use ($search) {
            $query->where(function ($sub_query) use ($search) {
                $sub_query->where('PART_NUMBER', 'LIKE', "%$search%")
                    ->orWhere('DESCRIPTION', 'LIKE', "%$search%")
                    ->orWhere('QUANTITY', 'LIKE', "%$search%")
                    ->orWhere('UNIT_MEASURE', 'LIKE', "%$search%")
                    ->orWhere('REGISTER_AIRCRAFT', 'LIKE', "%$search%")
                    ->orWhere('CUSTOMER', 'LIKE', "%$search%")
                    ->orWhere('DATE_INSTALL', 'LIKE', "%$search%")
                    ->orWhere('DATE_AIRCRAFT_IN', 'LIKE', "%$search%")
                    ->orWhere('DATE_AIRCRAFT_OUT', 'LIKE', "%$search%")
                    ->orWhere('TYPE_BC', 'LIKE', "%$search%")
                    ->orWhere('SUBMISSION_NUMBER', 'LIKE', "%$search%")
                    ->orWhere('SUBMISSION_DATE', 'LIKE', "%$search%")
                    ->orWhere('TTD_DATE', 'LIKE', "%$search%")
                    ->orWhere('CIF_IDR', 'LIKE', "%$search%");
            });
        })->when($search_part_number, function ($query) use ($search_part_number) {
            $query->where('PART_NUMBER', 'LIKE', "%$search_part_number%");
        })->when($search_description, function ($query) use ($search_description) {
            $query->where('DESCRIPTION', 'LIKE', "%$search_description%");
        })->when($search_quantity, function ($query) use ($search_quantity) {
            $query->where('QUANTITY', 'LIKE', "%$search_quantity%");
        })->when($search_unit_measure, function ($query) use ($search_unit_measure) {
            $query->where('UNIT_MEASURE', 'LIKE', "%$search_unit_measure%");
        })->when($search_register_aircraft, function ($query) use ($search_register_aircraft) {
            $query->where('REGISTER_AIRCRAFT', 'LIKE', "%$search_register_aircraft%");
        })->when($search_customer, function ($query) use ($search_customer) {
            $query->where('CUSTOMER', 'LIKE', "%$search_customer%");
        })->when($search_date_install, function ($query) use ($search_date_install) {
            $query->where('DATE_INSTALL', 'LIKE', "%$search_date_install%");
        })->when($search_date_aircraft_in, function ($query) use ($search_date_aircraft_in) {
            $query->whereDate('DATE_AIRCRAFT_IN', "$search_date_aircraft_in");
        })->when($search_date_aircraft_out, function ($query) use ($search_date_aircraft_out) {
            $query->whereDate('DATE_AIRCRAFT_OUT', "$search_date_aircraft_out");
        })->when($search_document_type, function ($query) use ($search_document_type) {
            $query->where('TYPE_BC', 'LIKE', "%$search_document_type%");
        })->when($search_submission_number, function ($query) use ($search_submission_number) {
            $query->where('SUBMISSION_NUMBER', 'LIKE', "%$search_submission_number%");
        })->when($search_submission_date, function ($query) use ($search_submission_date) {
            $query->where('SUBMISSION_DATE', 'LIKE', "%$search_submission_date%");
        })->when($search_ttd_date, function ($query) use ($search_ttd_date) {
            $query->whereDate('TTD_DATE', $search_ttd_date);
        })->when($search_cif_idr, function ($query) use ($search_cif_idr) {
            $query->where('CIF_IDR', 'LIKE', "%$search_cif_idr%");
        })->when($filter_start_date, function ($query) use ($filter_start_date) {
            $query->whereDate('DATE_INSTALL', '>=', $filter_start_date);
        })->when($filter_end_date, function ($query) use ($filter_end_date) {
            $query->whereDate('DATE_INSTALL', '<=', $filter_end_date);
        })->when($filter_customer, function ($query) use ($filter_customer) {
            $query->where('CUSTOMER', 'LIKE', "%$filter_customer%");
        })->when($filter_part_number, function ($query) use ($filter_part_number) {
            $query->where('PART_NUMBER', 'LIKE', "%$filter_part_number%");
        })->when($filter_submission_number, function ($query) use ($filter_submission_number) {
            $query->where('SUBMISSION_NUMBER', 'LIKE', "%$filter_submission_number%");
        })->when($filter_submission_date, function ($query) use ($filter_submission_date) {
            $query->where('SUBMISSION_DATE', '=', $filter_submission_date);
        })->when($filter_document_type, function ($query) use ($filter_document_type) {
            $query->whereIn('TYPE_BC', $filter_document_type);
        })->when(($order && $by), function ($query) use ($order, $by) {
            $query->orderBy($order, $by);
        })->get();

        return view('exports.outbounds.transaction_two', compact('outbounds'));
    }
}