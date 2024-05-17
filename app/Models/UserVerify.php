<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVerify extends Model
{
    use HasFactory;

    protected $guard = 'userVerify';

    protected $table = 'users_verify';
    
    protected $guard_name = 'web';

    protected $primaryKey  = 'user_id';

    protected $fillable = [
        'user_id',
        'token',
    ];
}

