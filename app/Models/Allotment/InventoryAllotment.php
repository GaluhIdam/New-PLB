<?php

namespace App\Models\Allotment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryAllotment extends Model
{
    use HasFactory;
    protected $connection = 'dummy';
    protected $table = 'tbl_allotment';

    protected $guarded = [];
}