<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $guard = 'roomModel';

    protected $table = 'roomTable';
    
    protected $guard_name = 'web';

    protected $primaryKey  = 'room_id';

    protected $fillable = [
        'photos',
        'room_number',
        'floor',
        'type_of_room',
        'number_of_bed',
        'details',
        'max_person',
        'price_per_hour',
        'is_available',
    ];
    protected $hidden = [
        'token',
    ];
}
