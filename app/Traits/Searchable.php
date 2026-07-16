<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Searchable
{
    /**
     * Apply search filter to query
     */
    public function scopeSearch(Builder $query, ?string $search, array $searchFields = []): Builder
    {
        if (!$search || empty($searchFields)) {
            return $query;
        }

        return $query->where(function (Builder $q) use ($search, $searchFields) {
            foreach ($searchFields as $field) {
                $q->orWhere($field, 'LIKE', "%{$search}%");
            }
        });
    }

    /**
     * Apply status filter to query
     */
    public function scopeFilterByStatus(Builder $query, ?string $status): Builder
    {
        if ($status === null || $status === '') {
            return $query;
        }

        if ($status === 'active') {
            return $query->where('status', true);
        }

        if ($status === 'inactive') {
            return $query->where('status', false);
        }

        return $query;
    }

    /**
     * Apply sort to query
     */
    public function scopeSortBy(Builder $query, ?string $sortField, ?string $sortOrder = 'asc'): Builder
    {
        if (!$sortField) {
            return $query;
        }

        return $query->orderBy($sortField, $sortOrder);
    }
}
