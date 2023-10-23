<?php

namespace App\Services\Movement;

use App\Models\Movement;
use Illuminate\Database\Eloquent\Collection;

class Services
{

    public function index($data)
    {

        $query = Movement::
        select(
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
        if(isset($data['date'])){
            $query->whereDate('created_at',date('Y-m-d',strtotime($data['date'])));
        }

        $query->orderBy('movements.id', 'desc');

        if(isset($data['paginate'])){
            $movement = $query->paginate($data['paginate'], ['*'], 'page', $data['page']);
        }
        else{
            $movement = $query->get();
        }



        return $movement;
    }

}
