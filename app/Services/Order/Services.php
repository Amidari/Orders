<?php

namespace App\Services\Order;

use App\Models\Movement;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Stock;
use Illuminate\Http\Request;

class Services
{
    use MovementStock;

    /**
     * Получение всех заказов
     * @param array $data
     * @return mixed
     */
    public function index(array $data): mixed
    {
        $query = Order::

        select(
            'orders.id as id',
            'customer',
            'warehouses.name as warehouse',
            'warehouses.id as warehouses_id',
            'created_at',
            'completed_at',
            'status'
        );
        $query->join('warehouses', 'warehouses.id', '=', 'orders.warehouse_id');

        if (isset($data['warehouse_id'])) {
            $query->where('warehouse_id', $data['warehouse_id']);
        }
        if (isset($data['customer'])) {
            $query->where('customer', 'like', "%{$data['customer']}%");
        }
        if (isset($data['status'])) {
            $query->where('status', $data['status']);
        }

        $query->orderBy('orders.id', 'desc');

        if (isset($data['paginate'])) {
            $orders = $query->paginate($data['paginate'], ['*'], 'page', $data['page']);
        } else {
            $orders = $query->get();
        }
        return $orders;
    }

    /**
     * Получение конкретного заказа
     * @param Order $order
     * @return mixed
     */
    public function show(Order $order): mixed
    {
        $orders = Order::find($order->id);
        $orders->created_at = date('d.m.Y', strtotime($orders->created_at));
        $orders->completed_at != null ? $orders->completed_at = date('d.m.Y', strtotime($orders->completed_at)) : $orders->completed_at = null;
        $items = OrderItem::select(
            'products.id as id',
            'products.name as name',
            'count')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->where('order_id', $order['id'])
            ->get();
        $stocks = Stock::query()
            ->select('product_id', 'stock')
            ->where('warehouse_id', $orders['warehouse_id'])
            ->get();
        $orders->products = $items;
        $orders->stocks = $stocks;

        return $orders;
    }

    /**
     * Добавление продукта в заказ
     * @param array $data
     * @return bool
     */
    public function store(array $data): bool
    {
        $stockProduct = Stock::where('warehouse_id', $data['warehouse_id'])
            ->where('product_id', $data['product_id'])
            ->first();

        //Проверка на наличие на складе
        if (($stockProduct->stock - $data['count']) < 0) {
            return false;
        }
        $stockProduct->stock = $stockProduct->stock - $data['count'];
        $stockProduct->save();

        $orderItem = new OrderItem();
        $orderItem->order_id = $data['order_id'];
        $orderItem->product_id = $data['product_id'];
        $orderItem->count = $data['count'];
        $orderItem->save();

        $this->writeStock($data['product_id'], $data['warehouse_id'], $data['count']);

        return true;
    }

    /**
     * Удаление продукта из заказа
     * @param array $data
     * @return bool
     */
    public function destroyProduct(array $data): bool
    {
        $stockProduct = Stock::where('warehouse_id', $data['warehouse_id'])
            ->where('product_id', $data['product_id'])
            ->first();
        $stockProduct->stock = $stockProduct->stock + $data['count'];
        $stockProduct->save();
        $orderItem = OrderItem::where('order_id', $data['order_id'])
            ->where('product_id', $data['product_id'])
            ->first();
        $orderItem->delete();
        $this->writeStock($data['product_id'], $data['warehouse_id'], $data['count']);

        return true;
    }

    /**
     * Обновление имени в заказе
     * @param Request $data
     * @return bool
     */
    public function refresh(Request $data): bool
    {
        $order = Order::find($data->order_id);
        $order->customer = $data->name;
        $order->save();
        return true;
    }

    /**
     * Создание нового заказа
     * @param array $data
     * @return bool
     */
    public function create(array $data): bool
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

    /**
     * Возобновить заказ
     * @param Order $data
     * @return bool
     */
    public function active(Order $data): bool
    {
        $items = OrderItem::select(
            'products.id as id',
            'products.name as name',
            'count')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->where('order_id', $data->id)
            ->get();

        //Если заказ пустой меняем статус
        if ($items->count() < 1) {
            $data->status = 'active';
            $data->save();
            return true;
        }
        $stocks = Stock::query()
            ->select('id', 'product_id', 'stock')
            ->where('warehouse_id', $data['warehouse_id'])
            ->get();

        //Проверка на наличие на складе
        foreach ($items as $item) {
            foreach ($stocks as $stock) {
                if ($item->id === $stock->product_id && $item->count > $stock->stock) {
                    return false;
                }
            }
        }
        //Снимаем со склада
        foreach ($items as $item) {
            foreach ($stocks as $stock) {
                if ($item->id === $stock->product_id) {
                    $stock->stock = $stock->stock - $item->count;
                    $stock->save();
                    $this->writeStock($item->id, $data['warehouse_id'], $item->count);
                }
            }
        }
        $data->status = 'active';
        $data->save();

        return true;
    }

    /**
     * Отмена заказа
     * @param Order $data
     * @return bool
     */
    public function canceled(Order $data): bool
    {
        $items = OrderItem::select(
            'products.id as id',
            'products.name as name',
            'count')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->where('order_id', $data->id)
            ->get();
        //Если заказ пустой меняем статус
        if ($items->count() < 1) {
            $data->status = 'canceled';
            $data->save();
            return true;
        }

        //Иначе возвращаем остатки
        $stocks = Stock::query()
            ->select('id', 'product_id', 'stock')
            ->where('warehouse_id', $data['warehouse_id'])
            ->get();

        foreach ($items as $item) {
            foreach ($stocks as $stock) {
                if ($item->id === $stock->product_id) {
                    $stock->stock = $stock->stock + $item->count;
                    $stock->save();
                    $this->creditingStock($item->id, $data['warehouse_id'], $item->count);
                }
            }
        }
        $data->status = 'canceled';
        $data->save();

        return true;
    }

    /**
     * Завершение заказа
     * @param Order $data
     * @return bool
     */
    public function completed(Order $data): bool
    {
        $data->completed_at = date("Y-m-d H:i:s");
        $data->status = 'completed';
        $data->save();
        return true;
    }


}
