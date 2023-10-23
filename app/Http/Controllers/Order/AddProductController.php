<?php

namespace App\Http\Controllers\Order;
use App\Http\Requests\Order\AddProductRequest;
use Illuminate\Http\Request;

use App\Models\Product;

class AddProductController extends BaseController
{
    /**
     * @param AddProductRequest $request
     * @return bool
     */
    public function __invoke(AddProductRequest $request):bool
    {

        $data = $request->validated();

        return $this->service->store($data);
    }
}
