<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContractorPersonResource extends JsonResource
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
                'Contractor_Person_Name' => $this->contractor_person_name ?? null,
                'Image'=> $this->image ?? null,
                'Specialty' => $this->specialty->name ?? null,
                'Rate' => $this->rate, 
                'Review' => $this->review,       
            ];
    }
}
