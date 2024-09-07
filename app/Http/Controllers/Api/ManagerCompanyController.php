<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResource;
use Illuminate\Http\Request;
use App\Models\ManagerComSub;
use App\Models\ManagerCompany;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ManagerCompanyResource;
use App\Http\Resources\ManagerCompanyShowResource;

class ManagerCompanyController extends Controller
{
    public function index()
    {
        $ManagerCompany = ManagerCompany::all();
        return ApiResource::getResponse(201, 'all data', ManagerCompanyResource::collection($ManagerCompany));
    }


    public function show($id)
    {


        try {
            $ManagerCompany = ManagerCompany::findOrFail($id); // ابحث عن المشروع بناءً على الـ ID
            return ApiResource::getResponse(200, 'Details ManagerCompany', new ManagerCompanyShowResource($ManagerCompany)); // استجابة مع تفاصيل المشروع
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ApiResource::getResponse(404, 'ID not found', []); // رسالة عندما يكون الـ ID غير موجود
        }
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

            $ManagerCompany = ManagerCompany::findOrFail($id);
            $ManagerCompany->update($allDataExceptFiles);



            if ($request->hasFile('commercial_registration_certificate')) {
                // حذف الوسائط القديمة للشعار
                $oldcommercial_registration_certificate = $ManagerCompany->getFirstMedia('commercial_registration_certificate');
                if ($oldcommercial_registration_certificate) {
                    $oldcommercial_registration_certificate->delete();
                }

                // رفع الشعار الجديد
                $uploadedcommercial_registration_certificate = $ManagerCompany->addMediaFromRequest('commercial_registration_certificate')->toMediaCollection('commercial_registration_certificate');

                // تحديث حقل الشعار في قاعدة البيانات
                $ManagerCompany->update([
                    'commercial_registration_certificate' => $uploadedcommercial_registration_certificate->getUrl(),
                ]);
            }

            if ($request->hasFile('vat_certificate')) {
                // حذف الوسائط القديمة للصورة
                $oldvat_certificate = $ManagerCompany->getFirstMedia('vat_certificate');
                if ($oldvat_certificate) {
                    $oldvat_certificate->delete();
                }

                // رفع الصورة الجديدة
                $uploadedvat_certificate = $ManagerCompany->addMediaFromRequest('vat_certificate')->toMediaCollection('vat_certificate');

                // تحديث حقل الصورة في قاعدة البيانات
                $ManagerCompany->update([
                    'vat_certificate' => $uploadedvat_certificate->getUrl(),
                ]);
            }

            if ($request->hasFile('social_insurance_certificate')) {
                // حذف الوسائط القديمة للصورة
                $oldsocial_insurance_certificate = $ManagerCompany->getFirstMedia('social_insurance_certificate');
                if ($oldsocial_insurance_certificate) {
                    $oldsocial_insurance_certificate->delete();
                }

                // رفع الصورة الجديدة
                $uploadedsocial_insurance_certificate = $ManagerCompany->addMediaFromRequest('social_insurance_certificate')->toMediaCollection('social_insurance_certificate');

                // تحديث حقل الصورة في قاعدة البيانات
                $ManagerCompany->update([
                    'social_insurance_certificate' => $uploadedsocial_insurance_certificate->getUrl(),
                ]);
            }

            if ($request->hasFile('chamber_of_commerce_certificate')) {
                // حذف الوسائط القديمة للصورة
                $oldchamber_of_commerce_certificate = $ManagerCompany->getFirstMedia('chamber_of_commerce_certificate');
                if ($oldchamber_of_commerce_certificate) {
                    $oldchamber_of_commerce_certificate->delete();
                }

                // رفع الصورة الجديدة
                $uploadedchamber_of_commerce_certificate = $ManagerCompany->addMediaFromRequest('chamber_of_commerce_certificate')->toMediaCollection('chamber_of_commerce_certificate');

                // تحديث حقل الصورة في قاعدة البيانات
                $ManagerCompany->update([
                    'chamber_of_commerce_certificate' => $uploadedchamber_of_commerce_certificate->getUrl(),
                ]);
            }

            if ($request->hasFile('company_profile')) {
                // حذف الوسائط القديمة للصورة
                $oldcompany_profile = $ManagerCompany->getFirstMedia('company_profile');
                if ($oldcompany_profile) {
                    $oldcompany_profile->delete();
                }

                // رفع الصورة الجديدة
                $uploadedcompany_profile = $ManagerCompany->addMediaFromRequest('company_profile')->toMediaCollection('company_profile');

                // تحديث حقل الصورة في قاعدة البيانات
                $ManagerCompany->update([
                    'company_profile' => $uploadedcompany_profile->getUrl(),
                ]);
            }




            $subspecialties = $request->subspecialty_id;


            if (isset($subspecialties)) {
                ManagerComSub::where('manager_company_id', $id)->delete();
                for ($i = 0; $i < sizeof($subspecialties); $i++) {
                    ManagerComSub::create([
                        'manager_company_id' => $id,
                        'subspecialty_id' => $subspecialties[$i],
                    ]);
                }
            }


            return ApiResource::getResponse(201, 'all data', ManagerCompanyShowResource::make($ManagerCompany));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ApiResource::getResponse(404, 'No Manager Company found with the given ID', []);
        }
    }
}
