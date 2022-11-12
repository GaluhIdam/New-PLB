<?php

namespace App\Models\Outbound;

use App\Models\Aircraft;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionOne extends Model
{
    use HasFactory;
    protected $connection = 'plb_db_prod';
    protected $table = 'v_tbl_outbound_one';
    protected  $appends = ['DATE_AIRCRAFT_IN'];

    public function getDateAircraftInAttribute()
    {
        if ($aircraft =  Aircraft::where('reg', $this->attributes['REGISTER_AIRCRAFT'])->first()) {
            return $aircraft->date_in;
        } else {
            return null;
        }
    }
}