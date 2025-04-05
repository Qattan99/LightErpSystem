<?php

namespace App\Modules\Products\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $images = [];

        foreach($this['productImage'] as $item){
            $images[] = asset($item['image']);
        }
        return [
            'id' => $this['id'],
            'name' => $this['name'],
            'type_id' => $this['type_id'],
            'details' => $this['details'],
            'color' => $this['color'],
            'cost' => $this['cost'],
            'image' => $images,
        ];
    }
}
