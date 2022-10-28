<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'username',
        'email',
        'last_login_at',
        'last_login_ip',
        'last_login_device'
    ];
}