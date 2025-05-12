<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
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
        'number_of_guests',
        'status',
        'total_price',
        'payment_status',
        'payment_method',
        'transaction_id',
        'stay_status',
    ];
}
