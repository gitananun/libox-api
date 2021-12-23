<?php

namespace App\Services;

use App\Models\Instructor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class InstructorService
{
    private function getQuery(): Builder | HasMany
    {
        return Instructor::query();
    }

    public function index(): LengthAwarePaginator
    {
        return $this->getQuery()->paginate();
    }

    public function search(string $name): LengthAwarePaginator
    {
        return $this->getQuery()
            ->where('name', 'LIKE', '%' . $name . '%')
            ->orWhere('lastname', 'LIKE', '%' . $name . '%')
            ->paginate();
    }
}