<?php

namespace App\Services\Order;

use App\Models\Movement;

trait MovementStock
{
    //Списание остотков
  public function writeStock($product_id, $warehouse_id, $count){
      $movement = new Movement();
      $movement->product_id = $product_id;
      $movement->warehouse_id = $warehouse_id;
      $movement->status = 'Списание';
      $movement->move = $count;
      $movement->created_at = date("Y-m-d H:i:s");
      $movement->save();
      return $movement;
  }
  //Поступление остатков
    public function creditingStock($product_id, $warehouse_id, $count){
        $movement = new Movement();
        $movement->product_id = $product_id;
        $movement->warehouse_id = $warehouse_id;
        $movement->status = 'Поступление';
        $movement->move = $count;
        $movement->created_at = date("Y-m-d H:i:s");
        $movement->save();
        return $movement;
    }

}
