<?php

namespace App\Models\Uploads;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutationReport extends Model
{
    use HasFactory;
    protected $table = 'tbl_mutation_reports';
    protected $timestamp = true;
    protected $fillable = [
        'part_number',
        'part_name',
        'unit',
        'saldo_awal',
        // 'opening_balance_quantity',
        // 'ending_balance_quantity',
        // 'adjusted_balance_quantity',
        // 'book_balance_quantity',
        'imported_at',
        'imported_by',
        'status'
    ];
}