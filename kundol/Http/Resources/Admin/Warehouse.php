<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class Warehouse extends JsonResource
{
    public function toArray($request)
    {
        return [
            'warehouse_id' => $this->id,
            'warehouse_code' => $this->code,
            'warehouse_name' => $this->name,
            'warehouse_address' => $this->address,
            'warehouse_phone' => $this->phone,
            'warehouse_email' => $this->email,
            'warehouse_status' => $this->status,
        ];
    }
}
