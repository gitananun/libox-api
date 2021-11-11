<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Auth\Passwords\CanResetPassword as TraitCanResetPassword;

class User extends Authenticatable implements CanResetPassword
{
    use HasFactory, HasApiTokens, Notifiable, TraitCanResetPassword;

    const ROLE_ADMIN = "ADMIN";
    const ROLE_BASIC = "BASIC";
    const ROLE_STUDENT = "STUDENT";

    const ROLES = [User::ROLE_ADMIN, User::ROLE_BASIC, User::ROLE_STUDENT];

    protected $fillable = [
        'name',
        'role',
        'email',
        'password',
        'lastname',
        'date_of_birth',
        'email_verified_at',
    ];

    protected $hidden = [
        'email_verified_at',
        'password',
        'created_at',
        'updated_at',
    ];

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function providers(): HasMany
    {
        return $this->hasMany(Provider::class);
    }

    public static function auth(): ?User
    {
        return auth()->user();
    }

    public function isAdmin(): bool
    {
        return $this->role === $this::ROLE_ADMIN;
    }

    public function favoriteCourses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'favorite_courses')->withTimestamps();
    }
}