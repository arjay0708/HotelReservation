<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reasonDeclineModel extends Model
{
    use HasFactory;

    protected $guard = 'reasonDeclineModel';

    protected $table = 'reasonDeclineTable';
    
    protected $guard_name = 'web';

    protected $primaryKey  = 'reasonDecline_id ';

    protected $fillable = [
        'reservation_id',
        'user_id',
        'reason',
    ];
    protected $hidden = [
        'token',
    ];
}
