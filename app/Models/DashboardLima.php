<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DashboardLima extends Model
{
    use HasFactory;

    protected $fillable = [
        'plant',
        'quantity',
    ];
}
