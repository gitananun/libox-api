<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'rating',
        'price',
        'length',
        'language',
        'description',
        'last_updated',
    ];
}