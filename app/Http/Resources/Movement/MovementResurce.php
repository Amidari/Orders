<?php

namespace App\Http\Resources\Movement;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovementResurce extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'move' => $this->move,
            'products' => $this->products,
            'status' => $this->status,
            'warehouses' => $this->warehouses,
            'created_at' => date_format($this->created_at, 'd.m.Y'),
        ];
    }
}
