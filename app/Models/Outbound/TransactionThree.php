<?php

namespace App\Models\Outbound;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionThree extends Model
{
    use HasFactory;

    protected $connection = 'db_plbGmf';
    protected $table = 'v_tbl_outbound_three';
}