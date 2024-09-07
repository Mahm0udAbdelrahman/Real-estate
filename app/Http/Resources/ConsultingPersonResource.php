<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Models\ServicePerson;
use App\Models\ConsultingPersonSub;
use App\Models\SubspecialtyTranslation;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsultingPersonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     *
     *
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
    public function toArray(Request $request): array
    {
        return
            [
                'id' =>$this->id,
                'Full_Name' => $this->full_name,
                'Profile_Photo' => $this->profile_photo,
                'Specialty' => $this->specialty_id,
                'Heart' =>$this->heart,
                 

            ];
    }
}