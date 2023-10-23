<?php

namespace App\Http\Controllers\Order;


use Illuminate\Http\Request;

class RefreshController extends BaseController
{
    /**
     * @param Request $request
     * @return bool
     */
    public function __invoke(Request $request): bool
    {
        return $this->service->refresh($request);
    }
}
