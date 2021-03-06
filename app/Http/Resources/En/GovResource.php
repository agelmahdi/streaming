<?php

namespace App\Http\Resources\En;

use Illuminate\Http\Resources\Json\JsonResource;

class GovResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "name" => $this->governorate_name_en,
            "cities"=>CityResource::collection($this->cities),
        ];
    }
}
