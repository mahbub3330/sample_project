<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use App\Services\FilterTrait;
class Product extends Model
{
    use HasFactory, FilterTrait;

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

    protected $table = 'products';

    const PER_PAGE = 10;
    const STATUS = ['Active', 'Disable'];

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
