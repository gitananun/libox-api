<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        'likes',
        'description',
        'last_updated',
    ];

    protected $dates = [
        'created_at',
        'last_updated',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function badge(): BelongsTo
    {
        return $this->belongsTo(Badge::class);
    }
}