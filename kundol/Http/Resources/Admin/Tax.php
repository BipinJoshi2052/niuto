<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class Tax extends JsonResource
{
    public function toArray($request)
    {
        return [
            'tax_id' => $this->id,
            'tax_title' => $this->title,
            'tax_description' => $this->description,
        ];
    }
}
