<?php

namespace App\Models\Outbound;

use App\Models\Aircraft;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionOne extends Model
{
    use HasFactory;
    protected $connection = 'plb_db_prod';
    protected $table = 'v_tbl_outbound_one';
}