<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outbound1 extends Model
{
    use HasFactory;

    protected $fillable = [
        'part_number',
        'description',
        'quantity',
        'unit_code',
        'register',
        'customer',
        'date_install',
        'date_ac_in'
    ];
}
