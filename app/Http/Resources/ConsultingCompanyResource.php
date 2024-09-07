<?php

namespace App\Http\Resources;

use App\Models\Specialty;
use App\Models\OtherProject;
use Illuminate\Http\Request;
use App\Models\ServiceCompany;
use App\Models\ConsultingCompanySub;
use App\Models\SubspecialtyTranslation;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsultingCompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function getSubspecialties($id)
    {
        $registerConsultingServiceCompany = ServiceCompany::findOrFail($id);
        $lang = app()->getLocale();
        $subspecialtyIds = ConsultingCompanySub::where('service_company_id', $registerConsultingServiceCompany->id)->pluck('subspecialty_id');

        // Retrieve the subspecialties and map them to an array with their names
        $subs = SubspecialtyTranslation::whereIn('subspecialty_id', $subspecialtyIds)
            ->where('locale', $lang)
            ->pluck('id', 'name') // Assuming 'name' is the field containing the subspecialty name
            ->toArray();

        return $subs;
    }


    public function toArray(Request $request): array
    {
        return
            [
                'id' => $this->id,
                'Company_Name' => $this->company_name,
                'Company_Company_Profile' => $this->company_profile,
                'Company_Specialty' => $this->specialty->name,
                'Company_Rate' => $this->rate,
                'Heart' =>$this->heart,

            ];
    }
}
