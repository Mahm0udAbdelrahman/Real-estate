<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Models\ManagerComSub;
use App\Models\ManagerCompany;
use App\Models\ManagerCompanySub;
use App\Models\SubspecialtyTranslation;
use Illuminate\Http\Resources\Json\JsonResource;

class ManagerCompanyResource extends JsonResource
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
            ->pluck('id','name')// Assuming 'name' is the field containing the subspecialty name
            ->toArray();

        return $subs;
    }
    public function toArray(Request $request): array
    {
        return
            [
                'id' =>$this->id,
                'Company_Name' => $this->company_name  ?? Null,
                'Company_Company_Profile' => $this->company_profile,
                'Company_Specialty' => $this->specialty_id ?? Null,
                'Company_Rate' => $this->rate,
                'Company_Review' => $this->review,
                'Company_Heart' =>$this->heart,
                

            ];
    }
}