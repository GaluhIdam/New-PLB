<?php

namespace App\Http\Controllers\API\Uploads;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Uploads\MutationReport;
use App\Imports\Uploads\ImportMutationReport;

class MutationReportController extends Controller
{
    use \App\Http\Traits\ActivityHistoryTrait;
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function import(Request $request)
    {
        $this->recordActivity('Upload Mutation Report');
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
            'imported_at' => 'required'
        ], [
            'file.required' => 'Pilih file yang akan diupload',
            'file.mimes' => 'Hanya file dengan format xls, xlsx, dan csv yang diperbolehkan',
            'imported_at.required' => 'Tanggal import harus diisi'

        ]);

        $data = $request->all();

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploaded_documents', 'public');
            $data['file'] = $path;
        }

        $mutation = MutationReport::create([
            'file' => $data['file'],
            'imported_at' => $data['imported_at'],
            'imported_by' => Auth::user()->name,
            'status' => 'active',
        ]);

        // Upload File Excel store to database
        Excel::import(new ImportMutationReport, $request->file('file')->store('public/uploads/mutation_reports'));

        return response()->json([
            'success' => true,
            'Messages' => 'Upload Mutation Report Berhasil',
            'data' => $mutation
        ], 200);
    }
}