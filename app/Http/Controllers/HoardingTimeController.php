<?php

namespace App\Http\Controllers;

use App\Models\HoardingTime;
use Illuminate\Http\Request;

class HoardingTimeController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }

    public function index(Request $request)
    {
        // $this->authorize('isAdmin');

        $search = $request->get('search');
        $search_bc_16_code = $request->get('search_bc_16_code');
        $search_registration_date = $request->get('search_registration_date');
        $search_registration_number = $request->get('search_registration_number');
        $search_submission_number = $request->get('search_submission_number');
        $search_date_of_filing = $request->get('search_date_of_filing');
        $search_item_code = $request->get('search_item_code');
        $search_item_name = $request->get('search_item_name');
        $search_unit = $request->get('search_unit');
        $search_total = $request->get('search_total');
        $search_status = $request->get('search_status');

        if ($request->get('order') && $request->get('by')) {
            $order = $request->get('order');
            $by = $request->get('by');
        } else {
            $order = 'id';
            $by = 'desc';
        }

        if ($request->get('paginate')) {
            $paginate = $request->get('paginate');
        } else {
            $paginate = 10;
        }

        $hoarding_times = HoardingTime::when($search, function ($query) use ($search) {
            $query->where('bc_16_code', 'like', '%' . $search . '%')
                ->orWhere('registration_date', 'like', '%' . $search . '%')
                ->orWhere('registration_number', 'like', '%' . $search . '%')
                ->orWhere('submission_number', 'like', '%' . $search . '%')
                ->orWhere('date_of_filing', 'like', '%' . $search . '%')
                ->orWhere('item_code', 'like', '%' . $search . '%')
                ->orWhere('item_name', 'like', '%' . $search . '%')
                ->orWhere('unit', 'like', '%' . $search . '%')
                ->orWhere('total', 'like', '%' . $search . '%')
                ->orWhere('status', 'like', '%' . $search . '%');
        })
            ->when($search_bc_16_code, function ($query) use ($search_bc_16_code) {
                $query->where('bc_16_code', 'like', '%' . $search_bc_16_code . '%');
            })
            ->when($search_registration_date, function ($query) use ($search_registration_date) {
                $query->where('registration_date', 'like', '%' . $search_registration_date . '%');
            })
            ->when($search_registration_number, function ($query) use ($search_registration_number) {
                $query->where('registration_number', 'like', '%' . $search_registration_number . '%');
            })
            ->when($search_submission_number, function ($query) use ($search_submission_number) {
                $query->where('submission_number', 'like', '%' . $search_submission_number . '%');
            })
            ->when($search_date_of_filing, function ($query) use ($search_date_of_filing) {
                $query->where('date_of_filing', 'like', '%' . $search_date_of_filing . '%');
            })
            ->when($search_item_code, function ($query) use ($search_item_code) {
                $query->where('item_code', 'like', '%' . $search_item_code . '%');
            })
            ->when($search_item_name, function ($query) use ($search_item_name) {
                $query->where('item_name', 'like', '%' . $search_item_name . '%');
            })
            ->when($search_unit, function ($query) use ($search_unit) {
                $query->where('unit', 'like', '%' . $search_unit . '%');
            })
            ->when($search_total, function ($query) use ($search_total) {
                $query->where('total', 'like', '%' . $search_total . '%');
            })
            ->when($search_status, function ($query) use ($search_status) {
                $query->where('status', 'like', '%' . $search_status . '%');
            })
            ->paginate($paginate);

        $query_string = [
            'search' => $search,
            'order' => $order,
            'by' => $by,
        ];

        $hoarding_times->appends($query_string);

        return $hoarding_times;
    }
}
