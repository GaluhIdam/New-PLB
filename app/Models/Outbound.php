<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outbound extends Model
{
    use HasFactory;

    protected $fillable = [
        'part_number',
        'condition',
        'description',
        'quantity',
        'unit_code',
        'register_ac',
        'customer',
        'date_install',
        'date_ac_in',
        'date_ac_out',
        'type_bc_out',
        'no_aju',
        'no_register',
        'cif_idr',
        'date_bc_out',
        'bm_paid',
        'ppn_paid',
        'pph_paid',
    ];
}
