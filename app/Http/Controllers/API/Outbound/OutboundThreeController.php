<?php

namespace App\Http\Controllers\API\Outbound;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Import Model
use App\Models\Outbound\TransactionThree;

class OutboundThreeController extends Controller
{
    /* 
    List Data yang dimunculin : 
    1. Part Number [$part_number] - db_plbGmf.TBL_PLB_SWIFT.MATNR
    2. Description [$description] - db_plbGmf.TBL_PLB_SWIFT.MAKTX 
    3. Quantity [$quantity] - db_plbGmf.TBL_PLB_SWIFT.ERFMG
    4. Kode Satuan [$unit_measure] - db_plbGmf.TBL_PLB_SWIFT.ERFME
    5. Register Aircraft [$register_aircraft]  - db_plbGmf.TBL_PLB_SWIFT.TPLNR
    6. customer [$customer] - db_plbGmf.TBL_PLB_SWIFT.KUNUM
    7. Date Install [$date_install] - db_plbGmf.TBL_PLB_SWIFT.BUDAT
    8. Date Aircraft In [$date_aircraft_in] - db_plb.aircraft.date_in
    9. Date Aircraft Out [$date_aircraft_out] - db_plb.aircraft.date_out
    10. Type BC OUT [$document_type] - db_plbGmf.TBL_PLB_SWIFT.JENIS_BC
    11. Nomor Aju [$submission_number] - db_plbGmf.TBL_PLB_SWIFT.NO_AJU
    12. Tanggal Aju [$submission_date] - db_plbGmf.TBL_PLB_SWIFT.TGL_AJU
    13. Nomor Daftar [$registration_number] = db_plbGmf.TBL_PLB_SWIFT.REGISTRATION_NUMBER
    14. Tanggal Daftar [$registration_date] = db_plbGmf.TBL_PLB_SWIFT.REGISTRATION_DATE
    15. CIF IDR [$cif_idr] - iplb_db_prod.PLB_HEADER.CIF_RUPIAH
    16. BM Bayar [$bm_dibayar] - iplb_db_prod.PLB_HEADER.JENIS_TARIF (if Jenis_Tarif = BM)
    17. PPn Bayar [$ppn_dibayar] - iplb_db_prod.PLB_HEADER.JENIS_TARIF (if Jenis_Tarif = PPN)
    18. PPh Bayar [pph_dibayar] - iplb_db_prod.PLB_HEADER.JENIS_TARIF (if Jenis_Tarif = PPh)
    */

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index(Request $request)
    {
        // Record Activity
        $this->recordActivity('Akses Outbound Transaction 2');
        // Search Data
        $search = $request->get('search'); // Untuk Pencarian Global
        $search_part_number = $request->get('search_part_number'); // Untuk Pencarian Part Number
        $search_description = $request->get('search_description'); // Untuk Pencarian Description
        $search_quantity = $request->get('search_quantity'); // Untuk Pencarian Quantity
        $search_unit_measure = $request->get('search_unit_measure'); // Untuk Pencarian Kode Satuan
        $search_register_aircraft = $request->get('search_register_aircraft'); // Untuk Pencarian Register Aircraft
        $search_customer = $request->get('search_customer'); // Untuk Pencarian Customer
        $search_date_install = $request->get('search_date_install'); // Untuk Pencarian Date Install
        $search_date_aircraft_in = $request->get('search_date_aircraft_in'); // Untuk Pencarian Date Aircraft In
        $search_date_aircraft_out = $request->get('search_date_aircraft_out'); // Untuk Pencarian Date Aircraft Out
        $search_document_type = $request->get('search_document_type'); // Untuk Pencarian Type BC
        $search_submission_number = $request->get('search_submission_number'); // Untuk Pencarian Nomor Aju
        $search_submission_date = $request->get('search_submission_date'); // Untuk Pencarian Tanggal Aju
        $search_registration_number = $request->get('search_registration_number'); // Untuk Pencarian Nomor Daftar
        $search_registration_date = $request->get('search_registration_date'); // Untuk Pencarian Tanggal Daftar
        $search_cif_idr = $request->get('search_cif_idr'); // Untuk Pencarian CIF IDR
        $search_bm_dibayar = $request->get('search_bm_dibayar'); // Untuk Pencarian BM Dibayar
        $search_ppn_dibayar = $request->get('search_ppn_dibayar'); // Untuk Pencarian PPN Dibayar
        $search_pph_dibayar = $request->get('search_pph_dibayar'); // Untuk Pencarian PPH Dibayar


        // Filter Data
        $filter_start_date = $request->get('filter_start_date'); // Untuk Filter Tanggal Start Date
        $filter_end_date = $request->get('filter_end_date'); // Untuk Filter Tanggal End Date
        $filter_customer = $request->get('filter_customer'); // Untuk Filter Customer
        $filter_submission_number = $request->get('filter_submission_number'); // Untuk Filter Nomor Aju
        $filter_submission_date = $request->get('filter_submission_date'); // Untuk Filter Tanggal Aju
        $filter_registration_number = $request->get('filter_registration_number'); // Untuk Filter Nomor Daftar
        $filter_registration_date = $request->get('filter_registration_date'); // Untuk Filter Tanggal Daftar
        $filter_part_number = $request->get('filter_part_number'); // Untuk Filter Part Number
        $filter_document_type = $request->get('filter_document_type');  // Untuk Filter Type BC

        // Sort Data
        if ($request->get('order') && $request->get('by')) {
            $order = $request->get('order');
            $by = $request->get('by');
        } else {
            $order = 'date_install';
            $by = 'desc';
        }

        // Paginate Data
        if ($request->get('paginate')) {
            $paginate = $request->get('paginate');
        } else {
            $paginate = 10;
        }
        // Query Untuk Menampilkan Data
        $outbounds  = TransactionThree::newTransactionThree()->when($search, function ($query) use ($search) {
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
                    ->orWhere('REGISTRATION_NUMBER', 'LIKE', "%$search%")
                    ->orWhere('REGISTRATION_DATE', 'LIKE', "%$search%")
                    ->orWhere('CIF_RUPIAH', 'LIKE', "%$search%")
                    ->orWhere('BM_DIBAYAR', 'LIKE', "%$search%")
                    ->orWhere('PPN_DIBAYAR', 'LIKE', "%$search%")
                    ->orWhere('PPH_DIBAYAR', 'LIKE', "%$search%");
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
            $query->where('DATE_AIRCRAFT_IN', 'LIKE', "%$search_date_aircraft_in%");
        })->when($search_date_aircraft_out, function ($query) use ($search_date_aircraft_out) {
            $query->where('DATE_AIRCRAFT_OUT', 'LIKE', "%$search_date_aircraft_out%");
        })->when($search_document_type, function ($query) use ($search_document_type) {
            $query->where('TYPE_BC', 'LIKE', "%$search_document_type%");
        })->when($search_submission_number, function ($query) use ($search_submission_number) {
            $query->where('SUBMISSION_NUMBER', 'LIKE', "%$search_submission_number%");
        })->when($search_submission_date, function ($query) use ($search_submission_date) {
            $query->where('SUBMISSION_DATE', 'LIKE', "%$search_submission_date%");
        })->when($search_registration_number, function ($query) use ($search_registration_number) {
            $query->where('REGISTRATION_NUMBER', 'LIKE', "%$search_registration_number%");
        })->when($search_registration_date, function ($query) use ($search_registration_date) {
            $query->where('REGISTRATION_DATE', 'LIKE', "%$search_registration_date%");
        })->when($search_cif_idr, function ($query) use ($search_cif_idr) {
            $query->where('CIF_IDR', 'LIKE', "%$search_cif_idr%");
        })->when($search_bm_dibayar, function ($query) use ($search_bm_dibayar) {
            $query->where('BM_DIBAYAR', 'LIKE', "%$search_bm_dibayar%");
        })->when($search_ppn_dibayar, function ($query) use ($search_ppn_dibayar) {
            $query->where('PPN_DIBAYAR', 'LIKE', "%$search_ppn_dibayar%");
        })->when($search_pph_dibayar, function ($query) use ($search_pph_dibayar) {
            $query->where('PPH_DIBAYAR', 'LIKE', "%$search_pph_dibayar%");
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
            $query->whereDate('SUBMISSION_DATE', 'LIKE', "%$filter_submission_date%");
        })->when($filter_registration_number, function ($query) use ($filter_registration_number) {
            $query->where('REGISTRATION_NUMBER', 'LIKE', "%$filter_registration_number%");
        })->when($filter_registration_date, function ($query) use ($filter_registration_date) {
            $query->whereDate('REGISTRATION_DATE', 'LIKE', "%$filter_registration_date%");
        })->when($filter_document_type, function ($query) use ($filter_document_type) {
            $query->whereIn('TYPE_BC', $filter_document_type);
        })->when(($order && $by), function ($query) use ($order, $by) {
            $query->orderBy($order, $by);
        })->paginate($paginate);

        $result = [
            'search' => $search,
            'order' => $order,
            'by' => $by,
        ];

        $outbounds->appends($result);
        return $outbounds;
    }
}