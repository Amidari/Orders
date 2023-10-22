<?php

namespace App\Http\Controllers\Order;


use App\Http\Resources\Order\OrderResurce;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class RefreshController extends BaseController
{
    public function __invoke(Request $request)
    {

        return $this->service->refresh($request);
    }
}
