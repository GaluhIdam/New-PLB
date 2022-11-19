<?php

namespace App\Models\Costums;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Outbound extends Model
{
    use HasFactory;
    protected $connection = 'plb_db_prod';
    protected $table = 'v_tbl_kepabeanan_outbound';
}