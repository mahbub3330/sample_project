<?php

namespace App\Services;

trait FilterTrait
{
    public function scopeFilterBy($query, $columns, $filter_by)
    {
        if (!$filter_by) {
            return $query;
        }
        if (is_string($columns)) {
            return $query->where($columns, $filter_by);
        }

        if (is_array($columns)) {
            foreach ($columns as $index => $column) {
                if ($index == 0) {
                    $query->where($column, $filter_by);
                } else {
                    $query->orWhere($column, $filter_by);
                }
            }
            return $query;
        }

    }

}
