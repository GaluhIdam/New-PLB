<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aircraft extends Model
{
    use HasFactory;

    protected $fillable = [
        'reg',
        'operator',
        'type',
        'date_in',
        'date_out',
        'rksp',
        'fight_route',
        'crews',
        'report'
    ];

    // protected $dates = [
    //     'date_in',
    //     'date_out',
    // ];

    // protected $casts = [
    //     'date_in' => 'datetime:m/d/Y',
    //     'date_out' => 'datetime:m/d/Y',
    // ];
}