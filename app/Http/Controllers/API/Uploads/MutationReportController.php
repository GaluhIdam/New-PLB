<?php

namespace App\Http\Controllers\API\Uploads;

use Illuminate\Http\Request;
use App\Models\Log\LogUploads;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Uploads\ImportMutationReport;

class MutationReportController extends Controller
{
    use \App\Http\Traits\ActivityHistoryTrait;
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function importExcel(Request $request)
    {
        $this->recordActivity('Upload Mutation Report');
        $request->validate([
            'selectSaldo' => 'required',
            'file' => 'required|mimes:cvs,xlsx,xls',
            'uploaded_at' => 'required'
        ], [
            'selectSaldo.required' => 'Saldo Awal atau Saldo Akhir harus dipilih',
            'file.required' => 'Pilih file yang akan diupload',
            'file.mimes' => 'Hanya file dengan format xls, xlsx, dan csv yang diperbolehkan',
            'uploaded_at.required' => 'Tanggal Saldo harus diisi'

        ]);

        $data = $request->all();

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads/mutation_reports', 'public');
            $data['file'] = $path;
        }

        $removeUnderScore = str_replace('_', ' ', $data['selectSaldo']);
        $selectSaldo = ucwords($removeUnderScore);

        $createLog = LogUploads::create([
            'name' => Auth::user()->name,
            'username' => Auth::user()->username,
            'email' => Auth::user()->email,
            'uploaded_to' => 'Upload data ' . $selectSaldo,
            'uploaded_at' => Carbon::parse(substr($data['uploaded_at'], 0, strpos($data['uploaded_at'], " (")))
        ]);

        // Upload File Excel store to database
        Excel::import(
            new ImportMutationReport($data['selectSaldo'], $data['uploaded_at']),
            request()->file('file')
        );

        return response()->json([
            'success' => true,
            'Messages' => 'Upload Mutation Report Berhasil',
            'Data' => $createLog,
        ], 200);
    }
}