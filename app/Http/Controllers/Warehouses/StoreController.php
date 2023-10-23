<?php

namespace App\Http\Controllers\Warehouses;

use App\Http\Requests\Warehous\StoreRequest;

class StoreController extends BaseController
{
    /**
     * Добавление склада
     * @param StoreRequest $request
     * @return bool
     */
    public function __invoke(StoreRequest $request): bool
    {
        $data = $request->validated();

        return $this->service->store($data);
    }
}
