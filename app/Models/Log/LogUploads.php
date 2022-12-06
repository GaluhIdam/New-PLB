<?php

namespace App\Models\Log;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogUploads extends Model
{
    use HasFactory;

    protected $table = 'tbl_log_uploads';
    protected $timestamp = true;
    protected $dates = [
        'deleted_at',
        'uploaded_at'
    ];
    protected $fillable = [
        'name',
        'username',
        'email',
        'uploaded_to',
        'uploaded_at',
        'uploaded_file'
    ];
}