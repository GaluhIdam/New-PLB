<?php

namespace App\Http\Controllers;

use App\Models\HoardingTime;
use Illuminate\Http\Request;

class HoardingTimeController extends Controller
{

    public function index(Request $request)
    {
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
        $search_reporting_year = $request->input('search_reporting_year');

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
            $query->where(function ($sub_query) use ($search) {
                $sub_query->where('bc_16_code', 'LIKE', "%{$search}%")
                    ->orWhere('registration_date', 'LIKE', "%{$search}%")
                    ->orWhere('registration_number', 'LIKE', "%{$search}%")
                    ->orWhere('submission_number', 'LIKE', "%{$search}%")
                    ->orWhere('date_of_filing', 'LIKE', "%{$search}%")
                    ->orWhere('item_code', 'LIKE', "%{$search}%")
                    ->orWhere('item_name', 'LIKE', "%{$search}%")
                    ->orWhere('unit', 'LIKE', "%{$search}%")
                    ->orWhere('total', 'LIKE', "%{$search}%")
                    ->orWhere('status', 'LIKE', "%{$search}%")
                    ->orWhere('reporting_year', 'LIKE', "%{$search}%");
            });
        })
            ->when($search_bc_16_code, function ($query) use ($search_bc_16_code) {
                $query->where('bc_16_code', 'LIKE', "%{$search_bc_16_code}%");
            })
            ->when($search_registration_date, function ($query) use ($search_registration_date) {
                $query->where('registration_date', 'like', "%{$search_registration_date}%");
            })
            ->when($search_registration_number, function ($query) use ($search_registration_number) {
                $query->where('registration_number', 'like', "%{$search_registration_number}%");
            })
            ->when($search_submission_number, function ($query) use ($search_submission_number) {
                $query->where('submission_number', 'like', "%{$search_submission_number}%");
            })
            ->when($search_date_of_filing, function ($query) use ($search_date_of_filing) {
                $query->where('date_of_filing', 'like', "%{$search_date_of_filing}%");
            })
            ->when($search_item_code, function ($query) use ($search_item_code) {
                $query->where('item_code', 'like', "%{$search_item_code}%");
            })
            ->when($search_item_name, function ($query) use ($search_item_name) {
                $query->where('item_name', 'like', "%{$search_item_name}%");
            })
            ->when($search_unit, function ($query) use ($search_unit) {
                $query->where('unit', 'like', "%{$search_unit}%");
            })
            ->when($search_total, function ($query) use ($search_total) {
                $query->where('total', 'like', "%{$search_total}%");
            })
            ->when($search_status, function ($query) use ($search_status) {
                $query->where('status', 'like', "%{$search_status}%");
            })
            ->when(function ($query) use ($search_reporting_year) {
                return $query->whereYear('registration_date', $search_reporting_year)->get();
            })
            ->when(($order && $by), function ($query) use ($order, $by) {
                $query->orderBy($order, $by);
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