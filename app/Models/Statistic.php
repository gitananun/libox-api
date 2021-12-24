<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Statistic extends Model
{
    use HasFactory;

    const CATEGORY_TYPE = "CATEGORY";
    const COURSE_TYPE = "COURSE";

    const TYPES = [Statistic::CATEGORY_TYPE, Statistic::COURSE_TYPE];

    protected $fillable = [
        'type',
        'record',
        'statisticable_id',
    ];
}