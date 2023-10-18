<?php


namespace App\Http\Controllers\Order;


use App\Http\Controllers\Controller;
use App\Services\Order\Services;

class BaseController extends Controller
{
    public Services $service;

    public function __construct(Services $service)
    {
        $this->service = $service;
    }

}
