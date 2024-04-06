<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payment';


    protected $fillable = [
        'payment_id',
        'amount',
        'customer_email',
        'payment_status',
        'payment_method',
    ];
}
