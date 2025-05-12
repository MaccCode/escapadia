<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
     protected $fillable = [
        'user_id',
        'property_id',
        'email',
        'name',
        'phone',
        'message',
    ];
}
