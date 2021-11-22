<?php

namespace App\Services;

use App\Models\Badge;
use Illuminate\Support\Collection;

class BadgeService
{
    public function index(): Collection
    {
        return Badge::all();
    }
}