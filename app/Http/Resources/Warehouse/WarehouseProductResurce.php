<?php

namespace App\Http\Resources\Warehouse;

use App\Http\Resources\Stock\StockResurce;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WarehouseProductResurce extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $stocks = Stock::select('stock')
            ->where('product_id', $this->getOriginal('pivot_product_id'))
            ->where('warehouse_id', $this->getOriginal('pivot_warehouse_id'))
            ->first();


        return [
            'id' => $this->id,
            'name' => $this->name,
            'stock' => $stocks->stock,

        ];
    }
}
