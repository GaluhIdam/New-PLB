<?php

namespace App\Models\Outbound;

use App\Models\Aircraft;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionTwo extends Model
{
    use HasFactory;
    protected $connection = 'plb_db_prod';
    protected $table = 'v_tbl_outbound_two';
    protected $appends = ['DATE_AIRCRAFT_IN', 'DATE_AIRCRAFT_OUT'];

    public function getDateAircraftInAttribute()
    {
        if ($aircraft =  Aircraft::where('reg', $this->attributes['REGISTER_AIRCRAFT'])->first()) {
            return $aircraft->date_in;
        } else {
            return null;
        }
    }

    public function getDateAircraftOutAttribute()
    {
        if ($aircraft =  Aircraft::where('reg', $this->attributes['REGISTER_AIRCRAFT'])->first()) {
            return $aircraft->date_out;
        } else {
            return null;
        }
    }
}
