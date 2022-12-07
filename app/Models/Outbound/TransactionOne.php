<?php

namespace App\Models\Outbound;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionOne extends Model
{
    use HasFactory;

    protected $table = 'v_tbl_outbound_one';
}