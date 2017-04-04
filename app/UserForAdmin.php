<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserForAdmin extends User
{
    protected $table    = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'role_id'
    ];

}
