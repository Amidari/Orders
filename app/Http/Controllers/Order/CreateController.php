<?php

namespace App\Http\Controllers\Order;


use App\Http\Requests\Order\StoreRequest;
use App\Http\Resources\Order\OrderResurce;

use Illuminate\Database\Eloquent\Collection;

class CreateController extends BaseController
{
    /**
     * @param StoreRequest $request
     * @return bool
     */
    public function __invoke(StoreRequest $request):bool
    {

        $data = $request->validated();

        return $this->service->create($data);
    }
}
