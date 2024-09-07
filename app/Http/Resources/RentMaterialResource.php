<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RentMaterialResource extends JsonResource
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
          'Description' => $this->bio,
          'Price' => $this->price,
          'Logo' => $this->logo,  
          'Rate' => $this->rate!=null  ?$this->rate:'0',
          'Review' => $this->review,
        ];
    }
}