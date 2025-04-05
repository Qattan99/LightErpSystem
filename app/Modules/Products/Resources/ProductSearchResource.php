<?php

namespace App\Modules\Products\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductSearchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this['id'],
            'name' => $this['name'],
            'type_id' => $this['type_id'],
            'details' => $this['details'],
            'color' => $this['color'],
            'cost' => $this['cost'],
            'image' => $this['one_image'] ? asset($this['one_image']['image']) : null,
        ];
    }
}
