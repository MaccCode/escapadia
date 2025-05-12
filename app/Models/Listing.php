<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'address',
        'image',
        'initial_price',
        'current_price',
        'guest_minimun',
        'guest_max',
        'bedroom_count',
        'bathroom_count',
        'additionals',
    ];
}
