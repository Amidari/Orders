<?php

namespace App\Http\Controllers\Warehouses;

use App\Http\Requests\Warehous\UpdateRequest;
use App\Models\Warehouse;


class UpdateController extends BaseController
{
    /**
     * Обновление склада
     * @param UpdateRequest $request
     * @param Warehouse $warehouse
     * @return bool
     */
    public function __invoke(UpdateRequest $request, Warehouse $warehouse):bool
    {
        $data = $request->validated();
        return $this->service->update($data,$warehouse);

    }
}
