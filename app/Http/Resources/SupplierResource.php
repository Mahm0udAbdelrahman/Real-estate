<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return
        [
            'ID' => $this->id,           
            'Name' => $this->name,
            'Image' => $this->image,
            'Supplied_Material' => $this->supplied_material,
            'Rate' => $this->rate,
            'Review' => $this->review,
        ];
    }
}