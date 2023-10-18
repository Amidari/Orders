<?php

namespace App\Http\Controllers\Product;



use App\Http\Resources\Product\ProductResurce;

class IndexController extends BaseController
{
    public function __invoke()
    {
        return ProductResurce::collection($this->service->index());
    }
}
