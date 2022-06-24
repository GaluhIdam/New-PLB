<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutationCalculation extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_code',
        'item_name',
        'unit',
        'first_balance',
        'income_bc16',
        'income_bc40',
        'income_bc27',
        'cost_bc28',
        'cost_bc41',
        'cost_bc27',
        'cost_bc30',
        'adjustment',
        'book_balance',
        'stock_opname',
        'difference',
        'date',
    ];
}
