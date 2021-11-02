<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
    ];

    public function getRouteKeyName(): string
    {
        return 'name';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(self::class, 'category_id');
    }

    public function categories(): HasMany
    {
        return $this->hasMany(self::class, 'category_id');
    }

    public function scopeParents(Builder $query): Builder
    {
        return $query->where('category_id', null);
    }
}