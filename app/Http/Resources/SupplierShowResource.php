<?php

namespace App\Http\Resources;

use App\Models\Supplier;
use App\Models\OtherProject;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function getprojects()
    {
        $suppliers =  Supplier::pluck('id')->first();
        $Supplierprojects = OtherProject::where('supplier_id',$suppliers)->latest()->get();    
        return OtherProjectResource::collection($Supplierprojects);
    }
    public function toArray(Request $request): array
    {
        return
        [
            'ID' => $this->id,
            'Name' => $this->name ?? null ,
            'Membership_No' => $this->membership_no ?? null ,
            'Image' => $this->image ?? null ,
            'Supplied_Material' => $this->supplied_material ?? null ,
            'Year_Of_Experience' => $this->year_of_experience ?? null ,
            'Country' => $this->country->name ?? null ,
            'City' => $this->city->name ?? null ,
            'Location' =>$this->location ?? null ,
            'Status' => $this->status,
            'Projects' => $this->getprojects(),
        ];
    }
}
