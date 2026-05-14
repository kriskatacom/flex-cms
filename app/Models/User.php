<?php

namespace Flex\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'options',
        'last_login'
    ];

    protected $casts = [
        'options' => AsArrayObject::class,
        'last_login' => 'datetime',
    ];

    protected $hidden = [
        'password',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = password_hash($value, PASSWORD_BCRYPT);
    }
}