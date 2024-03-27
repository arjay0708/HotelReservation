<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservationTable';

    protected $primaryKey = 'reservation_id';

    protected $fillable = [
        'book_code',
        'user_id',
        'room_id',
        'start_dataTime',
        'end_dateTime',
        'status',
        'is_archived',
        'is_noted',
    ];

    protected $casts = [
        'start_dataTime' => 'datetime',
        'end_dateTime' => 'datetime',
    ];
}
