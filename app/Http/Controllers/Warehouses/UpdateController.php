<?php

namespace App\Http\Controllers\Warehouses;

use App\Http\Requests\Warehous\StoreRequest;
use App\Models\Warehous;


class UpdateController extends BaseController
{
    public function __invoke(StoreRequest $request, Warehous $warehouse):bool
    {
        $data = $request->validated();
        return $this->service->update($data,$warehouse);

    }
}
