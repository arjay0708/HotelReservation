<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reasonDecline extends Model
{
    use HasFactory;

    protected $guard = 'reasonDeclineModel';

    protected $table = 'reason_decline_table';
    
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
