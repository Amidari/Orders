<?php

namespace App\Http\Controllers\Warehouses;

use App\Http\Requests\Warehous\UpdateRequest;
use App\Models\Warehous;


class UpdateController extends BaseController
{
    /**
     * Обновление склада
     * @param UpdateRequest $request
     * @param Warehous $warehouse
     * @return bool
     */
    public function __invoke(UpdateRequest $request, Warehous $warehouse):bool
    {
        $data = $request->validated();
        return $this->service->update($data,$warehouse);

    }
}
