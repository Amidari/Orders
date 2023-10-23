<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResurce extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $status_name = [
            'active' => 'В работе',
            'completed' =>'Завершен',
            'canceled' => 'Отменен',
        ];

        return [
            'id' => $this->id,
            'customer' => $this->customer,
            'warehouse' => $this->warehouse,
            'created_at' => date('d.m.Y', strtotime($this->created_at)),
            'completed_at' => date('d.m.Y', strtotime($this->completed_at)),
            'status' => $this->status,
            'status_name' =>$status_name[$this->status],

        ];
    }
}
