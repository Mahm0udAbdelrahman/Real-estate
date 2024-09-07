<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PartnerResource extends JsonResource
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
                'id' =>$this->id,               
                'Name' => $this->name ?? null,
                'Image' => $this->image ?? null,
                'Service_Type' => $this->specialty->name ?? null,
                'Rate' => $this->rate,
                'Review' => $this->review,
            ];
    }
}