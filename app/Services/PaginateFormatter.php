<?php

namespace App\Services;

class PaginateFormatter implements FormatterInterface
{

    public function format(array $arrayPaginationObject): array
    {
        return [
            'data' => $arrayPaginationObject['data'],
            'info' => [
                'per_page' => $arrayPaginationObject['per_page'],
                'count' => count($arrayPaginationObject['data']),
                'page' => $arrayPaginationObject['current_page'],
                "more_records" => !($arrayPaginationObject['current_page'] >= $arrayPaginationObject['last_page']),
            ]
        ];
    }
}
