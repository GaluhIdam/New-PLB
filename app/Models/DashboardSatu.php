<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DashboardSatu extends Model
{
    use HasFactory;

    protected $filable = [
        'status_bc_28',
        'item',
    ];
}
