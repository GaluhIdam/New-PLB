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
        'report',
        'ID_BARANG',
        'ID_HEADER'
    ];
}