<?php

namespace App\Http\Controllers\API\Uploads;

use Illuminate\Http\Request;
use App\Models\Log\LogUploads;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Uploads\MutationReport;
use App\Imports\Uploads\ImportMutationReport;

class UploadMutationController extends Controller
{
    use \App\Http\Traits\ActivityHistoryTrait;
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        // Record Activity History
        $this->recordActivity('Akses Halaman Upload Laporan Mutasi Barang');

        // Seach by keyword
        $search = $request->get('search');
        $search_tipe_saldo = $request->get('search_tipe_saldo');
        $search_tanggal_saldo = $request->get('search_tanggal_saldo');

        // Sort Data
        if ($request->get('order') && $request->get('by')) {
            $order = $request->get('order');
            $by = $request->get('by');
        } else {
            $order = 'id';
            $by = 'desc';
        }
        // Paginate
        if ($request->get('paginate')) {
            $paginate = $request->get('paginate');
        } else {
            $paginate = 10;
        }

        $uploads = MutationReport::when($search, function ($query) use ($search) {
            $query->where(function ($sub_query) use ($search) {
                $sub_query->where('tipe_saldo', 'LIKE', "%{$search}%")
                    ->orWhere('uploaded_at', 'LIKE', "%{$search}%");
            });
        })->when($search_tipe_saldo, function ($query) use ($search_tipe_saldo) {
            $query->where('tipe_saldo', 'LIKE', "%{$search_tipe_saldo}%");
        })->when($search_tanggal_saldo, function ($query) use ($search_tanggal_saldo) {
            $query->whereDate('uploaded_at', $search_tanggal_saldo);
        })->when(($order && $by), function ($query) use ($order, $by) {
            $query->orderBy($order, $by);
        })->groupBy('uploaded_at')
            ->paginate($paginate);

        $result = [
            'search' => $search,
            'order' => $order,
            'by' => $by,
            'paginate' => $paginate,
        ];

        $uploads->appends($result);
        return $uploads;
    }

    public function destroy($uploaded_at)
    {
        $this->recordActivity('Delete Report Mutation');

        $this->authorize('isAdmin');
        // Find and Delete File on Upload Mutation Report
        $upload = MutationReport::whereDate('uploaded_at', Carbon::parse($uploaded_at));
        $upload->delete();

        // Find and Delete File on Log Uploads
        $file = LogUploads::whereDate('uploaded_at', Carbon::parse($uploaded_at))->first();
        if ($file) {
            $file->delete();
            unlink(storage_path('app/public/' . $file->uploaded_file));
        } else {
            return response()->json([
                'Success' => false,
                'Message' => 'File not found'
            ], 404);
        }

        return response()->json([
            'Success' => true,
            'Message' => 'Data Berhasil Dihapus',
            'Log' => $file
        ], 200);
    }

    public function importExcel(Request $request)
    {
        $this->recordActivity('Upload Mutation Report');
        $request->validate([
            'tipe_saldo' => 'required',
            'file' => 'required|mimes:cvs,xlsx,xls',
            'uploaded_at' => 'required'
        ], [
            'tipe_saldo.required' => 'Saldo Awal atau Saldo Akhir harus dipilih',
            'file.required' => 'Pilih file yang akan diupload',
            'file.mimes' => 'Hanya file dengan format xls, xlsx, dan csv yang diperbolehkan',
            'uploaded_at.required' => 'Tanggal Saldo harus diisi'

        ]);

        $data = $request->all();

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads/mutation_reports', 'public');
            $data['file'] = $path;
        }

        $removeUnderScore = str_replace('_', ' ', $data['tipe_saldo']);
        $tipeSaldo = ucwords($removeUnderScore);

        $createLog = LogUploads::create([
            'name' => Auth::user()->name,
            'username' => Auth::user()->username,
            'email' => Auth::user()->email,
            'uploaded_to' => 'Upload data ' . $tipeSaldo,
            'uploaded_at' => Carbon::parse(substr($data['uploaded_at'], 0, strpos($data['uploaded_at'], " ("))),
            'uploaded_file' => $data['file'],
        ]);

        // Upload File Excel store to database
        Excel::import(
            new ImportMutationReport($data['tipe_saldo'], $data['uploaded_at']),
            request()->file('file')
        );

        return response()->json([
            'Success' => true,
            'Messages' => 'Upload Mutation Report Berhasil',
            'Data' => $createLog,
        ], 200);
    }
}