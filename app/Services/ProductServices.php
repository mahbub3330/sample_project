<?php

namespace App\Services;

use App\Models\Product;
use App\PaginationInfoTrait;
use Illuminate\Support\Facades\DB;

class ProductServices
{
    use PaginationInfoTrait;

    public function getProducts($param, FormatterInterface $formatter)
    {

        $per_page = $param['per_page'] ?? Product::PER_PAGE;
        $sort_order = in_array(strtolower($param['sort_order'] ?? ''), ['asc', 'desc']) ? strtolower($param['sort_order']) : 'desc';

        $filter_by = in_array(ucfirst($param['filter_by'] ?? ''), Product::STATUS) ? $param['filter_by'] : null;
        $sort_by = isset($param['sort_by']) ? strtolower($param['sort_by']) : 'id';
        $fillable = (new Product())->getFillable();

//        $productsObject = Product::query()
//            ->filterBy('status', strtolower($param['filter_by'] ?? ''))
//            ->where('default_name', 'LIKE', '%' . $param['search_text'] . '%')
//            ->orderByColumn($param['sort_by'] ?? 'id', $sort_order)
//            ->paginate($per_page);

        $fields = $param['fields'] ?? [];


        $query = DB::table((new Product())->getTable());
        if ($filter_by) {
            $query = $query->where('status', $filter_by);
        }

        if ($param['search_text']) {
            $query = $this->dynamicFieldSearch($query, $fields, $param['search_text']);
        }

        if (in_array($sort_by, array_merge(['id'], $fillable))) {
            $query = $query->orderBy($sort_by, $sort_order);
        }

        $productsObject = $query->paginate($per_page);
        return $formatter->format($productsObject->toArray());
    }

    public function dynamicFieldSearch($fields, $query, $search)
    {
        $search = '%' . $search . '%';
        foreach ($fields as $index => $field) {
            if ($index == 0) {
                $query = $query->where($field, 'LIKE', $search);
            } else {
                $query = $query->orWhere($field, 'LIKE', $search);
            }
        }

        return $query;
    }


}
