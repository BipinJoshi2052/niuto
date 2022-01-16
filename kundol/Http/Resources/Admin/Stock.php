<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\Admin\Product as ProductResource;
use App\Http\Resources\Admin\Warehouse as WarehouseResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Stock extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'product_id' => $this->product_id,
            'product_combination_id' => $this->product_combination_id,
            'warehouse_id' => $this->warehouse_id,
            'stock_status' => $this->stock_status,
            'qty' => $this->qty,
            'stock_type' => $this->stock_type,
            'product' => new ProductResource($this->whenLoaded('product')),
            'warehouse' => new WarehouseResource($this->whenLoaded('warehouse')),
        ];
    }
}
