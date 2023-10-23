<?php

namespace App\Http\Controllers\Movement;


use App\Http\Requests\Movement\IndexRequest;
use App\Http\Resources\Movement\MovementResurce;
use Illuminate\Http\JsonResponse;


class IndexController extends BaseController
{
    /**
     * @param IndexRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(IndexRequest $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {

        $data=$request->validated();

        return MovementResurce::collection($this->service->index($data));

    }
}
