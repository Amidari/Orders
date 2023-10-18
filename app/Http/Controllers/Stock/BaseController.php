<?php


namespace App\Http\Controllers\Stock;


use App\Http\Controllers\Controller;
use App\Services\Stock\Services;

class BaseController extends Controller
{
    public Services $service;

    public function __construct(Services $service)
    {
        $this->service = $service;
    }

}
