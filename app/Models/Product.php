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

    
    public function scopeFilterBy($query, $filter_by)
    {
        if($filter_by && in_array( ucfirst($filter_by),['Active' , 'Disable'] )){
            return $query->where('status', $filter_by);
        }
      
        return $query;
    }

    public function scopeOrderByColumn($query, $sort_by, $sort_order){

        if( in_array( strtolower($sort_by), array_merge(['id'], $this->fillable) )){
            return $query->orderBy($sort_by, $sort_order);
        }
      
        return $query;
    }



}
