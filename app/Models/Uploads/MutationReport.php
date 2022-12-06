<?php

namespace App\Models\Uploads;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MutationReport extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_mutation_reports';
    protected $timestamp = true;
    protected $dates = [
        'deleted_at',
        'uploaded_at'
    ];
    protected $fillable = [
        'part_number',
        'part_name',
        'unit',
        'saldo_awal',
        'saldo_akhir',
        'saldo_penyesuaian',
        'uploaded_at',
    ];
}