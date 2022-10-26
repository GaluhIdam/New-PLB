<?php

namespace App\Models\Costums;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inbound extends Model
{
    use HasFactory;
    protected $connection = 'plb_db_prod';


    public function scopeNewInbound()
    {
        $query = DB::connection('plb_db_prod')->table('v_tbl_inbound')
            ->select('*');

        return $query;
    }
}