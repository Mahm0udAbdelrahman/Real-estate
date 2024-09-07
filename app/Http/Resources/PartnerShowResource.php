<?php

namespace App\Http\Resources;

use App\Models\Partner;
use App\Models\OtherProject;
use Illuminate\Http\Request;
use App\Http\Resources\OtherProjectResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PartnerShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

     public function getprojects()
    {
        $partners =  Partner::pluck('id')->first();
        $partnerprojects = OtherProject::where('partner_id',$partners)->latest()->get();    
        return OtherProjectResource::collection($partnerprojects);
    }
    public function toArray(Request $request): array
    {
        return
            [
                'id' =>$this->id,
                'Membership_No' => $this->membership_no ,
                'Name' => $this->name ?? null,
                'Image' => $this->image ?? null,
                'Service_Type' => $this->specialty->name ?? null,
                'Membership_No' => $this->membership_no ?? null,
                'Year_Of_Experience' => $this->year_of_experience ?? null,
                'Country' => $this->country->name ?? null,
                'City' => $this->city->name ?? null,
                'Location' => $this->location ?? null,
                'Status' => $this->status,
                'Projects' => $this->getprojects(),
            ];
    }
}