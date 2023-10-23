<?php

namespace App\Http\Controllers\Product;



use App\Http\Resources\Product\ProductResurce;

class IndexController extends BaseController
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return ProductResurce::collection($this->service->index());
    }
}
