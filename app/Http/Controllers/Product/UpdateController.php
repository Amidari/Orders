<?php

namespace App\Http\Controllers\Product;

use App\Http\Requests\Product\StoreRequest;
use App\Models\Product;


class UpdateController extends BaseController
{
    public function __invoke(StoreRequest $request, Product $product):bool
    {
        $data = $request->validated();
        return $this->service->update($data,$product);

    }
}
