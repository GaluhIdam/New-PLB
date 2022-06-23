<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryAllotment extends Model
{
    use HasFactory;
    protected $fillable = [
        'part_number',
        'from_plant',
        'to_plant',
        'to_plant',
        'quantity',
        'unit_code',
    ];
}
