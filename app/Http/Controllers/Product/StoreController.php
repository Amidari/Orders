<?php

namespace App\Http\Controllers\Product;

use App\Http\Requests\Product\StoreRequest;

class StoreController extends BaseController
{

    public function __invoke(StoreRequest $request):bool
    {
        $data = $request->validated();

       return $this->service->store($data);

    }
}
