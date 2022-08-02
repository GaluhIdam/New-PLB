<?php

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutboundTransaction extends Model
{
    use HasFactory;
    protected $table = 'tbl_outbound';

    protected $guarded = [];
}