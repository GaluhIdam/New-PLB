<?php

namespace App\Models\Outbound;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionThree extends Model
{
    use HasFactory;

    protected $connection = 'db_plbGmf';

    public function scopeNewTransactionThree()
    {
        $query = DB::connection('db_plbGmf')->table('v_condition_three')
            ->select('*');

        return $query;
    }
}
