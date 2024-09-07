<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContractorCompanyResource extends JsonResource
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
            'Contractor_Company_Name' => $this->contractor_name ?$this->contractor_name:Null   ?? null,
            'Contractor_Company_Service_Type' => $this->specialty->name ?? null,
            'Contractor_Company_Image' => $this->image ?? null,
            'Contractor_Company_Rate' => $this->rate,
            'Contractor_Company_Review' => $this->review,
        ];
    }
}
