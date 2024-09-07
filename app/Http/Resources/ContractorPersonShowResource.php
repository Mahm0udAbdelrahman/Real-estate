<?php

namespace App\Http\Resources;

use App\Models\OtherProject;
use Illuminate\Http\Request;
use App\Models\ContractorPerson;
use Illuminate\Http\Resources\Json\JsonResource;

class ContractorPersonShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

     public function getprojects()
     {
         $ContractorPerson =  ContractorPerson::pluck('id')->first();
         $ContractorPersonprojects = OtherProject::where('contractor_person_id',$ContractorPerson)->latest()->get();    
         return OtherProjectResource::collection($ContractorPersonprojects);
     }
    public function toArray(Request $request): array
    {
        return
            [
                'id' =>$this->id,
                'Membership_No' => $this->membership_no,
                'Year_Of_Experience' => $this->year_of_experience,
                'Image'=> $this->image ?? null,
                'Email' => $this->email ?? null,
                'Phone' => $this->phone ?? null,
                'Country' => $this->country->name ?? null,
                'City' => $this->city->name ?? null,              
                'Specialty' => $this->specialty->name ?? null,
                'Status' => $this->status ?? null,
                'Contractor_Person_Address' => $this->contractor_person_address ?? null,
                'Contractor_Person_Name' => $this->contractor_person_name ?? null,
                'Projects' => $this->getprojects(),
            ];
    }
}
