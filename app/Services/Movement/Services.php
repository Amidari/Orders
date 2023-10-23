<?php

namespace App\Services\Movement;

use App\Models\Movement;
use Illuminate\Database\Eloquent\Collection;

class Services
{

    public function index($data):Collection
    {
        $query = Movement::query();
        $query->select(
            'movements.id',
            'status',
            'move',
            'created_at',
            'products.name as products',
            'warehouses.name as warehouses'
        );
        $query->join('products', 'products.id', '=', 'movements.product_id');
        $query->join('warehouses', 'warehouses.id', '=', 'movements.warehouse_id');

        if(isset($data['warehouse_id'])){
            $query->where('warehouse_id',$data['warehouse_id']);
        }
        if(isset($data['product_id'])){
            $query->where('product_id',$data['product_id']);
        }
        if(isset($data['status'])){
            $query->where('status',$data['status']);
        }
        if(isset($data['paginate'])){
            $query->paginate($data['paginate']);
        }
        $query->orderBy('movements.id', 'desc');
        $movement = $query->get();
        return $movement;
    }

}
