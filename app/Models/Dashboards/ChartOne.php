<?php

namespace App\Models\Dashboards;

use App\Models\Aircraft;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChartOne extends Model
{
    use HasFactory;

    protected $table = 'v_dashboard_one';
}