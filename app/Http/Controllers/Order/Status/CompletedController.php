<?php

namespace App\Http\Controllers\Order\Status;


use App\Http\Controllers\Order\BaseController;
use App\Http\Resources\Order\OrderResurce;
use App\Models\Order;

class CompletedController extends BaseController
{
    public function __invoke(Order $order)
    {

        return $this->service->completed($order);
    }
}
