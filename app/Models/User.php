<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens;

    const ROLE_ADMIN = "ADMIN";
    const ROLE_BASIC = "BASIC";
    const ROLE_STUDENT = "STUDENT";

    protected $fillable = [
        'name',
        'role',
        'email',
        'password',
        'lastname',
        'date_of_birth',
        'email_verified_at',
    ];

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}