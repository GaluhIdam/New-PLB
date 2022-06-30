<?php

namespace App\Http\Controllers;

use App\Models\Scrap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ScrapController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $search_material_document = $request->get('search_material_document');
        $search_material_item = $request->get('search_material_item');
        $search_material_code = $request->get('search_material_code');
        $search_material_description = $request->get('search_material_description');
        $search_batch_number = $request->get('search_batch_number');
        $search_plant_code = $request->get('search_plant_code');
        $search_storage_location = $request->get('search_storage_location');
        $search_submission_number = $request->get('search_submission_number');
        $search_submission_date = $request->get('search_submission_date');
        $search_registration_date = $request->get('search_registration_date');
        $search_registration_number = $request->get('search_registration_number');
        $search_recepient = $request->get('search_recepient');

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

        $scraps = Scrap::when($search, function ($query) use ($search) {
            $query->where(function ($sub_query) use ($search) {
                $sub_query->where('material_document', 'LIKE', "%{$search}%")
                    ->orWhere('material_item', 'LIKE', "%{$search}%")
                    ->orWhere('material_code', 'LIKE', "%{$search}%")
                    ->orWhere('material_description', 'LIKE', "%{$search}%")
                    ->orWhere('batch_number', 'LIKE', "%{$search}%")
                    ->orWhere('plant_code', 'LIKE', "%{$search}%")
                    ->orWhere('storage_location', 'LIKE', "%{$search}%")
                    ->orWhere('submission_number', 'LIKE', "%{$search}%")
                    ->orWhere('submission_date', 'LIKE', "%{$search}%")
                    ->orWhere('registration_date', 'LIKE', "%{$search}%")
                    ->orWhere('registration_number', 'LIKE', "%{$search}%")
                    ->orWhere('recepient', 'LIKE', "%{$search}%");
            });
        })
            ->when($search_material_document, function ($query) use ($search_material_document) {
                $query->where('material_document', 'LIKE', "%{$search_material_document}%");
            })
            ->when($search_material_item, function ($query) use ($search_material_item) {
                $query->where('material_item', 'LIKE', "%{$search_material_item}%");
            })
            ->when($search_material_code, function ($query) use ($search_material_code) {
                $query->where('material_code', 'LIKE', "%{$search_material_code}%");
            })
            ->when($search_material_description, function ($query) use ($search_material_description) {
                $query->where('material_description', 'LIKE', "%{$search_material_description}%");
            })
            ->when($search_batch_number, function ($query) use ($search_batch_number) {
                $query->where('batch_number', 'LIKE', "%{$search_batch_number}%");
            })
            ->when($search_plant_code, function ($query) use ($search_plant_code) {
                $query->where('plant_code', 'LIKE', "%{$search_plant_code}%");
            })
            ->when($search_storage_location, function ($query) use ($search_storage_location) {
                $query->where('storage_location', 'LIKE', "%{$search_storage_location}%");
            })
            ->when($search_submission_number, function ($query) use ($search_submission_number) {
                $query->where('submission_number', 'LIKE', "%{$search_submission_number}%");
            })
            ->when($search_submission_date, function ($query) use ($search_submission_date) {
                $query->where('submission_date', 'LIKE', "%{$search_submission_date}%");
            })
            ->when($search_registration_date, function ($query) use ($search_registration_date) {
                $query->where('registration_date', 'LIKE', "%{$search_registration_date}%");
            })
            ->when($search_registration_number, function ($query) use ($search_registration_number) {
                $query->where('registration_number', 'LIKE', "%{$search_registration_number}%");
            })
            ->when($search_recepient, function ($query) use ($search_recepient) {
                $query->where('recepient', 'LIKE', "%{$search_recepient}%");
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

        $scraps->appends($query_string);
        return $scraps;
    }
}