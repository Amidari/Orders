<?php

namespace App\Http\Controllers\Movement;


use App\Http\Requests\Movement\IndexRequest;
use App\Http\Resources\Movement\MovementResurce;


class IndexController extends BaseController
{
    public function __invoke(IndexRequest $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {


        $data=$request->validated();

        return MovementResurce::collection($this->service->index($data));
    }
}
