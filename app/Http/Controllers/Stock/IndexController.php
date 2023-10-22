<?php

namespace App\Http\Controllers\Stock;

use App\Http\Resources\Stock\StockResurce;
use App\Models\Stock;

class IndexController extends BaseController
{
    public function __invoke()
    {
        $stock = Stock::select(
            'product_id',
            'warehouses.name as warehouse',
            'stock')
            ->join('warehouses', 'warehouses.id', '=', 'stocks.warehouse_id')
            ->get();

        return StockResurce::collection($stock);
    }
}
