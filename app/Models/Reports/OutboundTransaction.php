<?php

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutboundTransaction extends Model
{
    use HasFactory;
    protected $connection = 'dummy';
    protected $table = 'tbl_outcon';

    protected $guarded = [];
}