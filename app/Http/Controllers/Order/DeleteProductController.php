<?php

namespace App\Http\Controllers\Order;


use App\Http\Requests\Order\DeleteProductRequest;

class DeleteProductController extends BaseController
{
    public function __invoke(DeleteProductRequest $request):bool
    {
        $data = $request->validated();
        return $this->service->destroyProduct($data);
    }
}
