<?php

namespace App\Models;

use App\Traits\StatisticableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
        'image_path',
        'lessons',
        'last_updated',
    ];

    protected $dates = [
        'created_at',
        'last_updated',
    ];

    protected $casts = [
        'certification' => 'boolean',
    ];

    protected $with = ['instructors', 'statistic'];

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

    public function statistic(): HasOne
    {
        return $this->hasOne(Statistic::class, 'statisticable_id', 'id');
    }
}