<?php


namespace App\Http\Controllers\Warehouses;


use App\Http\Controllers\Controller;
use App\Services\Warehouses\Services;

class BaseController extends Controller
{
    public Services $service;

    public function __construct(Services $service)
    {
        $this->service = $service;
    }

}
