<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'user_id',
        'fullname',
        'age',
        'gender',
        'email',
        'phone',
        'current_address',
        'permanent_address',
        'ID_image',
    ];
}
