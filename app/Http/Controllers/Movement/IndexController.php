<?php

namespace App\Http\Controllers\Movement;


use App\Http\Requests\Movement\IndexRequest;
use App\Http\Resources\Movement\MovementResurce;
use App\Models\Movement;


class IndexController extends BaseController
{
    public function __invoke(IndexRequest $request)
    {

        $data=$request->validated();

        return MovementResurce::collection($this->service->index($data));

    }
}
