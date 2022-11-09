<?php

namespace App\Models\Outbound;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Summary extends Model
{
    use HasFactory;
    protected $connection = 'db_plbGmf';
    protected $table = 'v_outbound_summary';
}