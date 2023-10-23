<?php

namespace App\Http\Controllers\Order\Status;


use App\Http\Controllers\Order\BaseController;
use App\Http\Resources\Order\OrderResurce;
use App\Models\Order;

class ActiveController extends BaseController
{
    public function __invoke(Order $order):bool
    {
        return $this->service->active($order);
    }
}
