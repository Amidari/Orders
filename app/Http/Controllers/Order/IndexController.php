<?php

namespace App\Http\Controllers\Order;


use App\Http\Requests\Order\IndexRequest;
use App\Http\Resources\Order\OrderResurce;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

class IndexController extends BaseController
{
    public function __invoke(IndexRequest $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {

        $data=$request->validated();
        return OrderResurce::collection($this->service->index($data));
    }
}
