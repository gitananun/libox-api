<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'rating',
        'price',
        'length',
        'user_id',
        'language',
        'description',
        'last_updated',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}