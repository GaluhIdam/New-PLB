<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomsInboundDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_type',
        'no_aju',
        'date_aju',
        'no_register',
        'date_register',
        'date_inbound',
        'sender',
        'owner',
        'item_code',
        'hs_code',
        'item_name',
        'quantity',
        'unit',
        'item_value',
        'attachment',
    ];
}
