<?php

namespace App\Models;

use App\Traits\StatisticableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    use HasFactory, StatisticableTrait;

    protected $fillable = [
        'title',
        'rating',
        'price',
        'length',
        'user_id',
        'language',
        'likes',
        'description',
        'last_updated',
        'image_path',
    ];

    protected $dates = [
        'created_at',
        'last_updated',
    ];

    protected $with = ['instructors'];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function badge(): BelongsTo
    {
        return $this->belongsTo(Badge::class);
    }

    public function instructors(): BelongsToMany
    {
        return $this->belongsToMany(Instructor::class);
    }
}