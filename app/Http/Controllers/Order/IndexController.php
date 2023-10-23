<?php

namespace App\Http\Controllers\Order;


use App\Http\Requests\Order\IndexRequest;
use App\Http\Resources\Order\OrderResurce;

class IndexController extends BaseController
{
    /**
     * @param IndexRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(IndexRequest $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {

        $data=$request->validated();
        return OrderResurce::collection($this->service->index($data));
    }
}
