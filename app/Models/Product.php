<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'default_name',
        'custom_name',
        'description',
        'status',
    ];

    const PER_PAGE = 10;
    const STATUS = ['Active', 'Disable'];


    public function scopeFilterBy($query, $filter_by)
    {
        if ($filter_by && in_array(ucfirst($filter_by), self::STATUS)) {
            return $query->where('status', $filter_by);
        }

        return $query;
    }


    public function scopeOrderByColumn($query, $sort_by, $sort_order)
    {
        if ( in_array(strtolower($sort_by), array_merge(['id'], $this->fillable)) ) {
            if (strtolower($sort_by) == 'id') {
                return $query->orderBy($sort_by, $sort_order);
            } else {
                return $query->when(strtolower($sort_order) == 'asc', function ($query) use ($sort_by) {
                    return $query->orderBy($sort_by);
                })->when(strtolower($sort_order) == 'desc', function ($query) use ($sort_by) {
                    return $query->orderByDesc($sort_by);
                });
            }
        }
        return $query;
    }


}
