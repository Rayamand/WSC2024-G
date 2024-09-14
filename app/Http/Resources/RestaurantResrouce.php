<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResrouce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "openState" => $this->openState,
            "description" => $this->description,
            "cateogry" => $this->category,
            $this->mergeWhen(isset($this->foods), [
                "foods" => $this->foods,
            ])
        ];
    }
}
