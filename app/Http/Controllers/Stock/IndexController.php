<?php

namespace App\Http\Controllers\Stock;

use App\Http\Resources\Stock\StockResurce;
use App\Models\Stock;

class IndexController extends BaseController
{
    /**
     * Получение продуктов с остатками по складам
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {

        return StockResurce::collection(Stock::select(
            'product_id',
            'warehouses.name as warehouse',
            'stock')
            ->join('warehouses', 'warehouses.id', '=', 'stocks.warehouse_id')
            ->get());
    }
}
