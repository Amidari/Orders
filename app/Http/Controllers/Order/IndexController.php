<?php

namespace App\Http\Controllers\Order;


use App\Http\Resources\Order\OrderResurce;

use Illuminate\Database\Eloquent\Collection;

class IndexController extends BaseController
{
    public function __invoke()
    {
        return OrderResurce::collection($this->service->index());
    }
}
