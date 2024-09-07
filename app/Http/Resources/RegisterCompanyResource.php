<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegisterCompanyResource extends JsonResource
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
            'Company_Name' => $this->company_name,
            'Description' => $this->bio,
            'Email'=> $this->email,
            'Phone' => $this->phone,
            'Image' => $this->image,
            'Number_Of_Employees'=> $this->number_of_employees,
            'Location'=> $this->location,
        ];
    }
}
