<?php

namespace App\Http\Resources;

use App\Models\OtherProject;
use Illuminate\Http\Request;
use App\Models\ServicePerson;
use App\Models\ConsultingPersonSub;
use App\Models\SubspecialtyTranslation;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsultingPersonShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

     public function getSubspecialties($id)
    {
        $registerConsultingServicePerson = ServicePerson::findOrFail($id);
        $lang = app()->getLocale();
        $subspecialtyIds = ConsultingPersonSub::where('service_person_id', $registerConsultingServicePerson->id)->pluck('subspecialty_id');

        // Retrieve the subspecialties and map them to an array with their names
        $subs = SubspecialtyTranslation::whereIn('subspecialty_id', $subspecialtyIds)
            ->where('locale', $lang)
            ->pluck('id','name') // Assuming 'name' is the field containing the subspecialty name
            ->toArray();

        return $subs;
    }
    public function getprojects()
    {
        $Serviceperson =  ServicePerson::pluck('id')->first();
        $Servicepersonprojects = OtherProject::where('service_person_id',$Serviceperson)->latest()->get();    
        return OtherProjectResource::collection($Servicepersonprojects);
    }
    public function toArray(Request $request): array
    {
        return
        [
            'ID' =>$this->id,
            'Full_Name' => $this->full_name,
            'Email' => $this->email,
            'Phone' => $this->phone,
            'Age' => $this->age,
            'Academic_Degree' => $this->academic_degree,
            'Year_Of_Experience' => $this->year_of_experience,
            'National' => $this->national_id,
            'Specialty' => $this->specialty_id,
            'Subspecialty' => $this->getSubspecialties($this->id),
            'Freelance_License' => $this->freelance_license,
            'Cv' => $this->cv,
            'Latest_Academic_Degree' => $this->latest_academic_degree,
            'Profile_Photo' => $this->profile_photo,
             

        ];
    }
}
