<?php

namespace App\Http\Controllers\Order;


use App\Http\Resources\Order\OrderShowResurce;
use App\Models\Order;


class ShowController extends BaseController
{
    public function __invoke(Order $order)
    {

//        return OrderShowResurce::collection($this->service->show($order));
        return response()->json($this->service->show($order));
    }
}
