<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Instructor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lastname',
        'job_title',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}