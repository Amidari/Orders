<?php

namespace App\Services\Order;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class Services
{

    public function index():Collection
    {
        return Order::select(
            'orders.id as id',
            'customer',
            'warehouses.name as warehouse',
            'created_at',
            'completed_at',
            'status'
        )->
        join('warehouses','warehouses.id', '=', 'orders.warehouse_id')
            ->orderBy('orders.id', 'desc')
            ->get();
    }

    public function show(Order $order)
    {

        $orders = Order::find($order->id);

        $items = OrderItem::select(
            'products.id as id',
            'products.name as name',
            'count')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->where('order_id', $order->id)
            ->get();

        $stocks = Stock::query()
            ->select('product_id', 'stock')
            ->where('warehouse_id', $orders['warehouse_id'])
            ->get();

        $orders->products = $items;
        $orders->stocks = $stocks;


        return $orders;
    }

    public function store($data):bool
    {

        $stockProduct = Stock::where('warehouse_id', $data['warehouse_id'])
            ->where('product_id',$data['product_id'])
            ->first();

        //Проверка на наличие на складе
            if(($stockProduct->stock-$data['count'])<0) {
                return false;
            }
            $stockProduct->stock = $stockProduct->stock-$data['count'];
            $stockProduct->save();


        $orderItem = new OrderItem();
        $orderItem->order_id = $data['order_id'];
        $orderItem->product_id = $data['product_id'];
        $orderItem->count = $data['count'];
        $orderItem->save();

        return true;
    }

    public function destroyProduct($data):bool
    {

        $stockProduct = Stock::where('warehouse_id', $data['warehouse_id'])
            ->where('product_id',$data['product_id'])
            ->first();

        $stockProduct->stock = $stockProduct->stock+$data['count'];
        $stockProduct->save();


        $orderItem = OrderItem::where('order_id', $data['order_id'])
            ->where('product_id', $data['product_id'])
            ->first();

        $orderItem->delete();
        return true;
    }

    public function refresh($data):bool
    {
        $order = Order::find($data->order_id);
        $order->customer = $data->name;
        $order->save();
        return true;
    }
    public function create($data):bool
    {
        $order = new Order();
        $order->customer = $data['customer'];
        $order->created_at = date("Y-m-d H:i:s");
        $order->completed_at = null;
        $order->warehouse_id = $data['warehouse_id'];
        $order->status = 'active';
        $order->save();
        return true;
    }



}
