<?php


namespace App\Http\Controllers\Movement;


use App\Http\Controllers\Controller;
use App\Services\Movement\Services;

class BaseController extends Controller
{
    public Services $service;

    public function __construct(Services $service)
    {
        $this->service = $service;
    }

}
