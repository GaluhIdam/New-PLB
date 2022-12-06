<?php

namespace App\Models\Uploads;

use App\Models\Log\LogUploads;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutationReport extends Model
{
    use HasFactory;

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
        'saldo_type',
        'uploaded_at',
    ];

    protected $appends = [
        'uploaded_file'
    ];

    public function getUploadedFileAttribute()
    {
        return LogUploads::where('uploaded_at', $this->attributes['uploaded_at'])->first()->uploaded_file;
    }
}