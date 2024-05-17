<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable 
{
    use HasFactory;

    protected $guard = 'userModel';

    protected $table = 'userTable';
    
    protected $guard_name = 'web';

    protected $primaryKey  = 'user_id';

    protected $fillable = [
        'photos',
        'lastname',
        'firstname',
        'middlename',
        'extention',
        'email',
        'phoneNumber',
        'birthday',
        'age',
        'password',
        'is_active',
        'is_admin',        
        'email_verified'
    ];
    protected $hidden = [
        'token',
    ];

}