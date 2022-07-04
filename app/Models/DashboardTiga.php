<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DashboardTiga extends Model
{
    use HasFactory;

    protected $fillable = [
        'bulan',
        'total_bc28',
        'payment_value_bc28',
    ];
}
