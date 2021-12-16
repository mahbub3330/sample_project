<?php

namespace App;

trait PaginationInfoTrait
{
    public function formatPaginationInfo($paginationObject): array
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
