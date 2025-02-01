<?php

namespace Workbench\App\Models;

use BradieTilley\Snowflakes\Eloquent\HasSnowflake;
use Illuminate\Foundation\Auth\User as AuthUser;

class User extends AuthUser
{
    use HasSnowflake;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
