<?php

namespace App\Services;

use App\Models\Product;

class ProductServices
{

    public function getProducts($param): array
    {

        $per_page = $param['per_page'] ?? Product::PER_PAGE;
        $sort_order = in_array(strtolower($param['sort_order'] ?? ''), ['asc', 'desc']) ? strtolower($param['sort_order']) : 'desc';

        $productsObject = Product::query()
            ->filterBy(strtolower($param['filter_by'] ?? ''))
            ->where('default_name', 'LIKE', '%' . $param['search_text'] . '%')
            ->orderByColumn($param['sort_by'] ?? 'id', $sort_order)
            ->paginate($per_page, ['*'], 'page');

        return $this->formatProducts($productsObject->toArray());
    }

    public function formatProducts($paginationObject): array
    {
        return [
            'data' => $paginationObject['data'],
            'info' => [
                'per_page' => $paginationObject['per_page'],
                'count' => count($paginationObject['data']),
                'page' => $paginationObject['current_page'],
                "more_records" => !($paginationObject['current_page'] >= $paginationObject['last_page']),
            ]
        ];

    }

}
