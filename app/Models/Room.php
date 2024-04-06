<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'roomTable';

    protected $fillable = [
        'photos',
        'room_number',
        'floor',
        'type_of_room',
        'number_of_bed',
        'details',
        'max_person',
        'price',
        'is_available',
    ];
}
