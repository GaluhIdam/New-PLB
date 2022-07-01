<?php

namespace App\Http\Controllers;

use App\Models\DashboardDua;
use App\Models\DashboardEmpat;
use App\Models\DashboardLima;
use App\Models\DashboardSatu;
use App\Models\DashboardTiga;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboardSatu()
    {
        $dashboard_satu = DashboardSatu::all();
        return $dashboard_satu;
    }
    public function dashboardDua()
    {
        $dashboard_dua = DashboardDua::all();

        return $dashboard_dua;
    }
    public function dashboardTiga()
    {
        $dashboard_tiga = DashboardTiga::all();

        return $dashboard_tiga;
    }
    public function DashboardEmpat()
    {
        $dashboard_empat = DashboardEmpat::all();

        return $dashboard_empat;
    }
    public function DashboardLima()
    {
        $dashboard_lima = DashboardLima::all();

        return $dashboard_lima;
    }
}
