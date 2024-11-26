<?php

namespace App\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait HasFilter {
    public function scopeFilter(Builder $query, array $filters = []): Builder
    {
        if (empty($filters)) {
            return $query;
        }

        if (property_exists($this, 'filterable')) {
            return $query;
        }

        $filterables = $this->filterable;

        foreach ($filters as $column => $filter) {
            if ($filter === "" || $filter == null) {
                continue;
            }

            if (!in_array($column, $filterables)) {
                continue;
            }

            $query->where($column, $filter);
        }

    }
}
