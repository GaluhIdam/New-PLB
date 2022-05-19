<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aircraft extends Model
{
    use HasFactory;
    protected $fillable = [
        'operator','reg','type','activity_type','actual_time','fight_route','crews','report'  
    ];
}