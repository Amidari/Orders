<?php

namespace App\Http\Controllers\Order;


use App\Models\Order;


class ShowController extends BaseController
{
    /**
     * @param Order $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Order $order): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->service->show($order));
    }
}
