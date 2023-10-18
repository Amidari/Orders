<?php

namespace App\Http\Controllers\Warehouses;



use App\Http\Resources\Warehouse\WarehouseResurce;

class IndexController extends BaseController
{
    public function __invoke()
    {
        return WarehouseResurce::collection($this->service->index());
    }
}
