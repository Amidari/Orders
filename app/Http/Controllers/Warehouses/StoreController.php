<?php

namespace App\Http\Controllers\Warehouses;

use App\Http\Requests\Warehous\StoreRequest;

class StoreController extends BaseController
{

    public function __invoke(StoreRequest $request):bool
    {
        $data = $request->validated();

       return $this->service->store($data);

    }
}
