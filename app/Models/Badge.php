<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Badge extends Model
{
    use HasFactory;

    const HOT_NEW = "Hot & new";
    const BESTSELLER = "Bestseller";
    const HIGHEST_RATED = "Highest rated";

    const NAMES = [Badge::HOT_NEW, Badge::BESTSELLER, Badge::HIGHEST_RATED];

    protected $fillable = [
        'name',
    ];

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class);
    }
}