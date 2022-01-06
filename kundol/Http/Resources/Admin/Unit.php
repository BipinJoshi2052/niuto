<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Admin\UnitDetail as UnitDetailResource;

class Unit extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $unit_detail = UnitDetail::where('unit_id',$this->id)->where('language_id','1')->first();
        //UnitDetailResource::collection($this->whenLoaded('detail'))
        return [
                'id' => $this->id,
                'is_active' => $this->is_active,
                'detail' => UnitDetailResource::collection($this->whenLoaded('detail')),
                'unit_name' =>  $unit_detail
        ];
    }
}