<?php

namespace App\Services\Order;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Collection;

class Services
{

    public function index():Collection
    {
        return Order::select(
            'customer',
            'warehouses.name as warehouse',
            'created_at',
            'completed_at',
            'status'
        )->
        join('warehouses','warehouses.id', '=', 'orders.warehouse_id')
            ->get();
    }

    public function show(Order $order):Collection
    {
        //dd($order);
        return OrderItem::select(
            'products.name as product',
            'count')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->where('order_id', $order->id)
            ->get();
    }



}
