<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResource;
use Illuminate\Http\Request;
use App\Models\ServiceCompany;
use App\Http\Controllers\Controller;
use App\Models\ConsultingCompanySub;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ConsultingCompanyResource;
use App\Http\Resources\ConsultingCompanyShowResource;

class ConsultingCompanyController extends Controller
{
    public function index()
    {
        $ConsultingCompany = ServiceCompany::all();

        return ApiResource::getResponse(201, 'all data', ConsultingCompanyResource::collection($ConsultingCompany));
    }

    public function show($id)
    {
        
            $Contractors = ServiceCompany::find($id);
            if(!$Contractors)
            {
                return ApiResource::getResponse(404, 'No Company found with the given ID');
            }
            return ApiResource::getResponse(201, 'Show Consulting Company', ConsultingCompanyShowResource::make($Contractors));
        
    }


    public function update(Request $request, $id)
    {
        try {
            $validation = Validator::make(
                $request->all(),
                [
                    'company_name' => 'required|string',
                    'bio' => 'required|string',
                    'email' => 'required|email',
                    'phone' => 'required|string',
                    'location' => 'required|string',
                    'number_of_employees' => 'required|string',
                    'number_of_branches' => 'required|string',
                    'year_of_experience' => 'required|string',
                    'commercial_registration_certificate' => 'file|max:2048',
                    'vat_certificate' => 'file|max:2048',
                    'social_insurance_certificate' => 'file|max:2048',
                    'chamber_of_commerce_certificate' => 'file|max:2048',
                    'company_profile' => 'file|max:2048',
                    'specialty_id' => 'required|string',
                    'subspecialty_id' => 'required|array',
                ],


            );

            if ($validation->fails()) {
                return ApiResource::getResponse(422, 'Enter the data correctly', $validation->errors());
            }


            $allDataExceptFiles = $request->except(['commercial_registration_certificate', 'vat_certificate', 'social_insurance_certificate', 'chamber_of_commerce_certificate', 'company_profile']);

            $ConsultingCompanyFile = ServiceCompany::findOrFail($id);
            $ConsultingCompanyFile->update($allDataExceptFiles);



            if ($request->hasFile('commercial_registration_certificate')) {
                // حذف الوسائط القديمة للشعار
                $oldcommercial_registration_certificate = $ConsultingCompanyFile->getFirstMedia('commercial_registration_certificate');
                if ($oldcommercial_registration_certificate) {
                    $oldcommercial_registration_certificate->delete();
                }

                // رفع الشعار الجديد
                $uploadedcommercial_registration_certificate = $ConsultingCompanyFile->addMediaFromRequest('commercial_registration_certificate')->toMediaCollection('commercial_registration_certificate');

                // تحديث حقل الشعار في قاعدة البيانات
                $ConsultingCompanyFile->update([
                    'commercial_registration_certificate' => $uploadedcommercial_registration_certificate->getUrl(),
                ]);
            }

            if ($request->hasFile('vat_certificate')) {
                // حذف الوسائط القديمة للصورة
                $oldvat_certificate = $ConsultingCompanyFile->getFirstMedia('vat_certificate');
                if ($oldvat_certificate) {
                    $oldvat_certificate->delete();
                }

                // رفع الصورة الجديدة
                $uploadedvat_certificate = $ConsultingCompanyFile->addMediaFromRequest('vat_certificate')->toMediaCollection('vat_certificate');

                // تحديث حقل الصورة في قاعدة البيانات
                $ConsultingCompanyFile->update([
                    'vat_certificate' => $uploadedvat_certificate->getUrl(),
                ]);
            }

            if ($request->hasFile('social_insurance_certificate')) {
                // حذف الوسائط القديمة للصورة
                $oldsocial_insurance_certificate = $ConsultingCompanyFile->getFirstMedia('social_insurance_certificate');
                if ($oldsocial_insurance_certificate) {
                    $oldsocial_insurance_certificate->delete();
                }

                // رفع الصورة الجديدة
                $uploadedsocial_insurance_certificate = $ConsultingCompanyFile->addMediaFromRequest('social_insurance_certificate')->toMediaCollection('social_insurance_certificate');

                // تحديث حقل الصورة في قاعدة البيانات
                $ConsultingCompanyFile->update([
                    'social_insurance_certificate' => $uploadedsocial_insurance_certificate->getUrl(),
                ]);
            }

            if ($request->hasFile('chamber_of_commerce_certificate')) {
                // حذف الوسائط القديمة للصورة
                $oldchamber_of_commerce_certificate = $ConsultingCompanyFile->getFirstMedia('chamber_of_commerce_certificate');
                if ($oldchamber_of_commerce_certificate) {
                    $oldchamber_of_commerce_certificate->delete();
                }

                // رفع الصورة الجديدة
                $uploadedchamber_of_commerce_certificate = $ConsultingCompanyFile->addMediaFromRequest('chamber_of_commerce_certificate')->toMediaCollection('chamber_of_commerce_certificate');

                // تحديث حقل الصورة في قاعدة البيانات
                $ConsultingCompanyFile->update([
                    'chamber_of_commerce_certificate' => $uploadedchamber_of_commerce_certificate->getUrl(),
                ]);
            }

            if ($request->hasFile('company_profile')) {
                // حذف الوسائط القديمة للصورة
                $oldcompany_profile = $ConsultingCompanyFile->getFirstMedia('company_profile');
                if ($oldcompany_profile) {
                    $oldcompany_profile->delete();
                }

                // رفع الصورة الجديدة
                $uploadedcompany_profile = $ConsultingCompanyFile->addMediaFromRequest('company_profile')->toMediaCollection('company_profile');

                // تحديث حقل الصورة في قاعدة البيانات
                $ConsultingCompanyFile->update([
                    'company_profile' => $uploadedcompany_profile->getUrl(),
                ]);
            }

            $subspecialties = $request->subspecialty_id;


            if (isset($subspecialties)) {
                ConsultingCompanySub::where('service_company_id', $id)->delete();
                for ($i = 0; $i < sizeof($subspecialties); $i++) {
                    ConsultingCompanySub::create([
                        'service_company_id' => $id,
                        'subspecialty_id' => $subspecialties[$i],
                    ]);
                }
            }

            return ApiResource::getResponse(201, 'all data', ConsultingCompanyShowResource::make($ConsultingCompanyFile));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ApiResource::getResponse(404, 'No Company found with the given ID', []);
        }
    }
}
