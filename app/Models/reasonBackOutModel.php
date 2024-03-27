<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reasonBackOutModel extends Model
{
    use HasFactory;

    protected $guard = 'reasonBackOutModel';

    protected $table = 'reasonBackOutTable';
    
    protected $guard_name = 'web';

    protected $primaryKey  = 'reasonBackOut_id';

    protected $fillable = [
        'reservation_id',
        'user_id',
        'reason',
        'set_by_admin',
    ];
    protected $hidden = [
        'token',
    ];

}

