<?php

namespace App\Http\Resources;

use App\Models\Contractor;
use App\Models\OtherProject;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContractorCompanyShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

     public function getprojects()
     {
         $Contractor =  Contractor::pluck('id')->first();
         $Contractorprojects = OtherProject::where('contractor_id',$Contractor)->latest()->get();    
         return OtherProjectResource::collection($Contractorprojects);
     }
    public function toArray(Request $request): array
    {
        return
            [
                'id' =>$this->id,
                'Membership_No' => $this->membership_no,
                'Contractor_Company_Name' => $this->contractor_name ?? null,
                'Contractor_Company_Service Type' => $this->specialty->name ?? null,
                'Contractor_Company_Image' => $this->image ?? null,
                'Contractor_Company_Rate' => $this->rate,
                'Company_Size' => $this->company_size ?? null,
                'Country' => $this->country->name ?? null,
                'City' => $this->city->name ?? null,
                'contractor_Company_Address' => $this->contractor_address ?? null,
                'Status' => $this->status,
                'Projects' => $this->getprojects(),
            ];
    }
}