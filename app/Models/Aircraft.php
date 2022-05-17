<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aircraft extends Model
{
    use HasFactory;
    protected $fillable = [
        'operator','reg','type','activity_type','ata','atd','fight_route','crews','report'  
    ];
}