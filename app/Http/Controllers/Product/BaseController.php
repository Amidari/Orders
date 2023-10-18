<?php


namespace App\Http\Controllers\Product;


use App\Http\Controllers\Controller;
use App\Services\Product\Services;

class BaseController extends Controller
{
    public Services $service;

    public function __construct(Services $service)
    {
        $this->service = $service;
    }

}
