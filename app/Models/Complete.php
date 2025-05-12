<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complete extends Model
{
    protected $fillable = [
        'user_id',
        'property_id',
        'lister_id',
        'email',
        'name',
        'phone',
        'start_date',
        'end_date',
        'price',
        'payment_status',
        'status',
    ];
}
