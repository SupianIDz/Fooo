<?php

namespace App\Models;

/**
 * @mixin IdeHelperUser
 */
class User extends \Illuminate\Foundation\Auth\User
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
}
