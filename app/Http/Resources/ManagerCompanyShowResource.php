<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Models\ManagerComSub;
use App\Models\ManagerCompany;
use App\Models\SubspecialtyTranslation;
use Illuminate\Http\Resources\Json\JsonResource;

class ManagerCompanyShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

     public function getSubspecialties($id)
     {
         $registerManagerCompany = ManagerCompany::findOrFail($id);
         $lang = app()->getLocale();
         $subspecialtyIds = ManagerComSub::where('manager_company_id', $registerManagerCompany->id)->pluck('subspecialty_id');
 
         // Retrieve the subspecialties and map them to an array with their names
         $subs = SubspecialtyTranslation::whereIn('subspecialty_id', $subspecialtyIds)
             ->where('locale', $lang)
             ->pluck('id','name') // Assuming 'name' is the field containing the subspecialty name
             ->toArray();
 
         return $subs;
     }
    public function toArray(Request $request): array
    {
        return
        [
            'ID' =>$this->id,
            'Company_Name' => $this->company_name,
            'Company_Email' => $this->email,
            'Company_Description' => $this->bio,
            'Company_Phone' => $this->phone,
            'Company_location' => $this->location,
            'Company_Number_Of_Employees' => $this->number_of_employees,
            'Company_Number_Of_Branches' => $this->number_of_branches,
            'Company_Year_Of_Experience' => $this->year_of_experience,
            'Company_Rate' => $this->rate,
            'Company_Commercial_Registration_Certificate' => $this->commercial_registration_certificate,
            'Company_Vat_Certificate' => $this->vat_certificate,
            'Company_Social_Insurance_Certificate' => $this->social_insurance_certificate,
            'Company_Chamber_Of_Commerce_Certificate' => $this->chamber_of_commerce_certificate,
            'Company_Company_Profile' => $this->company_profile,
            'Company_Specialty' => $this->specialty_id,
            'Company_Subspecialty' => $this->getSubspecialties($this->id),

        ];
    }
}
