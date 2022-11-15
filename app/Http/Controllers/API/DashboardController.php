<?php

namespace App\Http\Controllers\API;

use App\Models\Aircraft;
use Illuminate\Http\Request;
use App\Models\DashboardSatu;
use App\Models\DashboardTiga;
use Illuminate\Support\Facades\DB;
use App\Models\Dashboards\ChartOne;
use App\Http\Controllers\Controller;
use App\Models\Dashboards\ChartThree;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function chartOne()
    {
        $this->recordActivity('Akses Dashboard');
        // Status Outbound Dashboard
        $mutations1 = Aircraft::whereNull('date_out')->pluck('reg');
        $mutations2 = Aircraft::whereDate('date_out', '<=', now()->subDays(14))->pluck('reg');
        $mutations3 = Aircraft::whereDate('date_out', '>', now()->subDays(14))->pluck('reg');
        $mutations4 = Aircraft::pluck('reg');

        // Outbound pada Pesawat di Area PLB GMF
        $conditionOne = ChartOne::whereIn('REGISTER_AIRCRAFT', $mutations1)->count();

        // Outbound <= 14 Hari sejak Pesawat Keluar
        $conditionTwo = ChartOne::whereIn('REGISTER_AIRCRAFT', $mutations2)->count();

        // Outbound > 14 Hari sejak Pesawat Keluar
        $conditionThree = ChartOne::whereIn('REGISTER_AIRCRAFT', $mutations3)->count();

        // Sudah Dibuat BC 28
        $conditionFour = ChartOne::whereIn('REGISTER_AIRCRAFT', $mutations4)->whereNotNull('NO_DAFTAR')->count();

        // Return Response in array each object condition
        return response()->json([
            [
                'labels' => 'Di Area GMF',
                'series' => $conditionOne,
            ], [
                'labels' => 'Outbound <= 14 Hari',
                'series' => $conditionTwo,
            ],
            [
                'labels' => 'Outbound > 14 Hari',
                'series' => $conditionThree,
            ],
            [
                'labels' => 'Sudah BC 28',
                'series' => $conditionFour,
            ]
            //             Outbound pada Pesawat di Area PLB GMF
            //              Outbound <= 14 Hari sejak Pesawat Keluar
            // Outbound > 14 Hari sejak Pesawat Keluar
            // Sudah dibuat BC 28
        ]);
    }

    public function chartTwo()
    {

        $aircrafts = Aircraft::whereNull('date_out')->groupBy('operator')->selectRaw('operator as labels , count(*) as series')->get();
        return response()->json($aircrafts);
    }

    public function chartThree(Request $request)
    {
        $from = new Carbon($request->from);
        $to = new Carbon($request->to);

        return ChartThree::select(
            DB::raw("count(NOMOR_AJU) as 'series'"),
            DB::raw("DATE_FORMAT(TANGGAL_DAFTAR, '%M %y') labels"),
            DB::raw('YEAR(TANGGAL_DAFTAR) year, MONTH(TANGGAL_DAFTAR) month'),
            DB::raw("sum(TOTAL_BAYAR) as 'value'")
        )
            ->when($from, function ($query) use ($from) {
                $query->whereDate('TANGGAL_DAFTAR', '>=', $from);
            })
            ->when($to, function ($query) use ($to) {
                $query->whereDate('TANGGAL_DAFTAR', '<=', $to);
            })
            ->orderBy('TANGGAL_DAFTAR', 'asc')
            ->groupBy('year', 'month')
            ->get();
    }
}