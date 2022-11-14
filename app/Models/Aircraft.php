<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aircraft extends Model
{
    use HasFactory;

    protected $fillable = [
        'AIRCRAFT_REGISTRATION',
        'AIRCRAFT_TYPE',
        'OPERATOR',
        'DATE_AIRCRAFT_IN',
        'DATE_AIRCRAFT_OUT',
        'RKSP',
        'FLIGHT_ROUTE',
        'CREWS',
        'REPORT',
        'ID_HEADER',
        'ID_BARANG'
    ];
}