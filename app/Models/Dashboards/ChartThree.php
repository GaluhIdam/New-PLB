<?php

namespace App\Models\Dashboards;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChartThree extends Model
{
    use HasFactory;

    protected $table = 'v_dashboard_three';
    protected $dates = ['TANGGAL_DAFTAR'];
}