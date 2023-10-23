<?php

namespace App\Http\Controllers\Warehouses;



use App\Http\Resources\Warehouse\WarehouseResurce;

class IndexController extends BaseController
{
    /**
     * Получение всех складов
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return WarehouseResurce::collection($this->service->index());
    }
}
