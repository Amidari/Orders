<?php

namespace App\Http\Controllers\Warehouses;

use App\Http\Requests\Warehous\StoreRequest;
use App\Models\Warehous;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DestroyController extends BaseController
{
    public function __invoke(Warehous $warehouse)
    {
        $this->service->destroy($warehouse);
        return response([]);
    }
}
