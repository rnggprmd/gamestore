<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Searchable
{
    /**
     * Apply search filter to query (uses parameterized LIKE - safe from SQL injection)
     */
    public function scopeSearch(Builder $query, ?string $search, array $searchFields = []): Builder
    {
        if (!$search || empty($searchFields)) {
            return $query;
        }

        // Sanitize search: max 255 chars to prevent DoS
        $search = substr($search, 0, 255);

        return $query->where(function (Builder $q) use ($search, $searchFields) {
            foreach ($searchFields as $field) {
                // Only allow alphanumeric + underscore column names to prevent column injection
                if (preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $field)) {
                    $q->orWhere($field, 'LIKE', "%{$search}%");
                }
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
     * Apply sort to query (whitelist-based to prevent column injection)
     */
    public function scopeSortBy(Builder $query, ?string $sortField, ?string $sortOrder = 'asc', array $allowedFields = []): Builder
    {
        if (!$sortField || empty($allowedFields)) {
            return $query;
        }

        // Whitelist check - only allow explicitly allowed fields
        if (!in_array($sortField, $allowedFields, true)) {
            return $query;
        }

        // Whitelist sort direction
        $direction = strtolower($sortOrder) === 'desc' ? 'desc' : 'asc';

        return $query->orderBy($sortField, $direction);
    }
}
