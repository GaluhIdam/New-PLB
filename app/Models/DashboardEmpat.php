<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DashboardEmpat extends Model
{
    use HasFactory;

    protected $fillable = [
        'status_bc_16',
        'jumlah_bc_16',
    ];
}
