<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovementAllotment extends Model
{
    use HasFactory;
    protected $fillable = [
        'osa',
        'first_balance',
        'kno_plus',
        'kno_min',
        'upg_plus',
        'upg_min',
        'sub_plus',
        'sub_min',
        'bpn_plus',
        'bpn_min',
        'dps_plus',
        'dps_min',
        'cgk_plus',
        'cgk_min',
        'consumption_install',
        'return_to_plb_gmf',
        'return_to_plb_gmf',
    ];
}
