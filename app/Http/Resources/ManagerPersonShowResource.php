<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Models\ManagerPerson;
use App\Models\ManagerPersonSub;
use App\Models\SubspecialtyTranslation;
use Illuminate\Http\Resources\Json\JsonResource;

class ManagerPersonShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function getSubspecialties($id)
    {
        $registerManagerPerson = ManagerPerson::findOrFail($id);
        $lang = app()->getLocale();
        $subspecialtyIds = ManagerPersonSub::where('manager_person_id', $registerManagerPerson->id)->pluck('subspecialty_id');

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
            'id' =>$this->id,
            'Full_Name' => $this->full_name,
            'Email' => $this->email,
            'Phone' => $this->phone,
            'Age' => $this->age,
            'Academic_Degree' => $this->academic_degree,
            'Year_Of_Experience' => $this->year_of_experience,
            'National' => $this->national_id,
            'Specialty' => $this->specialty->name,
            'Subspecialty' => $this->getSubspecialties($this->id),
            'Freelance_License' => $this->freelance_license,
            'Cv' => $this->cv,
            'Latest_Academic_Degree' => $this->latest_academic_degree,
            'Profile_Photo' => $this->profile_photo,
        ];
    }
}
