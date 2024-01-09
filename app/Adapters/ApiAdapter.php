<?php

namespace App\Adapters;

use App\Http\Resources\DefaultResource;
use App\Repositories\PaginationInterface;

class ApiAdapter
{
    public static function toJson(PaginationInterface $data)
    {
        return DefaultResource::collection($data->items())->additional([
            'meta' => [
                'total' => $data->total(),
                'isFirstPage' => $data->isFirstPage(),
                'isLastPage' => $data->isLastPage(),
                'currentPage' => $data->currentPage(),
                'getNumberNextPage' => $data->getNumberNextPage(),
                'getNumberPreviosPage' => $data->getNumberPreviosPage(),
            ]
        ]);
    }
}
