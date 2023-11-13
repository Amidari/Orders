<?php

namespace App\Http\Controllers\Warehouses;

use App\Http\Requests\Warehous\StoreRequest;
use App\Models\Warehouse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DestroyController extends BaseController
{
    /**
     * Удаление склада
     * @param Warehouse $warehouse
     * @return bool
     */
    public function __invoke(Warehouse $warehouse): bool
    {
        $this->service->destroy($warehouse);
        return true;
    }
}
