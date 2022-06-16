<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutationPeriodic extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_code',
        'item_name',
        'unit',
        'beginning_balance',
        'in_bc_16',
        'in_bc_40',
        'in_bc_27',
        'out_bc_28',
        'out_bc_41',
        'out_bc_27',
        'adjustment',
        'book_balance',
        'inventory_taking',
        'difference'
    ];
}
