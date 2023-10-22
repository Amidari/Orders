<?php

namespace App\Http\Controllers\Order;
use App\Http\Requests\Order\AddProductRequest;
use Illuminate\Http\Request;

use App\Models\Product;

class AddProductController extends BaseController
{
    public function __invoke(AddProductRequest $request):bool
    {

        $data = $request->validated();
//        dd($data);
        return $this->service->store($data);
    }
}
