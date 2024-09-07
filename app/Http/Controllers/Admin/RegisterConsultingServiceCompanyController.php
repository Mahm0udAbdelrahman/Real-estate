<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Models\Specialty;
use App\Models\Subspecialty;
use Illuminate\Http\Request;
use App\Models\ServiceCompany;
use App\Http\Controllers\Controller;
use App\Models\ConsultingCompanySub;
use App\Models\RegisterConsultingServiceCompany;
use App\Models\SubspecialtyTranslation;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class RegisterConsultingServiceCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $register_companies = ServiceCompany::latest()->get();
        $lang=app()->getLocale();
        return view('admin.dashboard.ConsultingServiceCompany.index', compact('register_companies','lang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specialties = Specialty::all();
        return view('admin.dashboard.ConsultingServiceCompany.create',compact('specialties'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'email' => "required|email|unique:service_companies,email",
            'phone' => 'required|string',
            'location' => 'required|string',
            'number_of_employees' => 'required|string',
            'number_of_branches' => 'required|string',
            'year_of_experience' => 'required|string',
            'commercial_registration_certificate' => 'required|file|max:2048',
            'vat_certificate' => 'required|file|max:2048',
            'social_insurance_certificate' => 'required|file|max:2048',
            'chamber_of_commerce_certificate' => 'required|file|max:2048',
            'company_profile' => 'required|file|max:2048',
            'specialty_id' => 'required|string',
            'status' => 'required|string',
        ];

        foreach ($locales as $localeCode => $properties) {
            $rules["{$localeCode}.company_name"] = 'nullable';
            $rules["{$localeCode}.bio"] = 'nullable';


        }

        $request->validate($rules);

        $allDataExceptFiles = $request->except(['commercial_registration_certificate', 'vat_certificate', 'social_insurance_certificate', 'chamber_of_commerce_certificate', 'company_profile']);
        $ConsultingCompanyFile = ServiceCompany::create($allDataExceptFiles);

        // تحميل وتحديث الشعار إذا تم إرسال ملف الشعار
        if ($request->hasFile('commercial_registration_certificate')) {
            $uploadedcommercial_registration_certificate = $ConsultingCompanyFile->addMediaFromRequest('commercial_registration_certificate')->toMediaCollection('commercial_registration_certificate');
            $ConsultingCompanyFile->update(['commercial_registration_certificate' => $uploadedcommercial_registration_certificate->getUrl()]);
        }

        // تحميل وتحديث الصورة إذا تم إرسال ملف الصورة
        if ($request->hasFile('vat_certificate')) {
            $uploadedvat_certificate = $ConsultingCompanyFile->addMediaFromRequest('vat_certificate')->toMediaCollection('vat_certificate');
            $ConsultingCompanyFile->update(['vat_certificate' => $uploadedvat_certificate->getUrl()]);
        }
        if ($request->hasFile('social_insurance_certificate')) {
            $uploadedsocial_insurance_certificate = $ConsultingCompanyFile->addMediaFromRequest('social_insurance_certificate')->toMediaCollection('social_insurance_certificate');
            $ConsultingCompanyFile->update(['social_insurance_certificate' => $uploadedsocial_insurance_certificate->getUrl()]);
        }

        if ($request->hasFile('chamber_of_commerce_certificate')) {
            $uploadedchamber_of_commerce_certificate = $ConsultingCompanyFile->addMediaFromRequest('chamber_of_commerce_certificate')->toMediaCollection('chamber_of_commerce_certificate');
            $ConsultingCompanyFile->update(['chamber_of_commerce_certificate' => $uploadedchamber_of_commerce_certificate->getUrl()]);
        }


        if ($request->hasFile('company_profile')) {
            $uploadedcompany_profile = $ConsultingCompanyFile->addMediaFromRequest('company_profile')->toMediaCollection('company_profile');
            $ConsultingCompanyFile->update(['company_profile' => $uploadedcompany_profile->getUrl()]);
        }
        $subspecialty = $request->subspecialty_id;
        for($i=0;$i<sizeof($subspecialty);$i++)
        {
            ConsultingCompanySub::create([
                'service_company_id' => $ConsultingCompanyFile->id ,
                'subspecialty_id' => $subspecialty[$i],
            ]);
        }


        return redirect()->route('ConsultingServiceCompany.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $registerConsultingServiceCompany = ServiceCompany::findOrFail($id);
        $specialties = Specialty::all();
        // $selectedSpecialtyId = $registerConsultingServiceCompany->specialty_id;
        $lang=app()->getLocale();
        // $selectedSubspecialtyId = $registerConsultingServiceCompany->subspecialty_id;
        $subspecialtyIds = ConsultingCompanySub::where('service_company_id',$registerConsultingServiceCompany->id)->pluck('subspecialty_id');

        $subs = SubspecialtyTranslation::whereIn('subspecialty_id', $subspecialtyIds)->where('locale', $lang)->get();

        $companySubs=ConsultingCompanySub::where('service_company_id',$id)->get();



        return view('admin.dashboard.ConsultingServiceCompany.edit', compact(
            'registerConsultingServiceCompany',
            'specialties',
            // 'selectedSpecialtyId',
            'lang',
            'companySubs',
            'subs'
        ));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
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
            'status' => 'required|string',
        ];

        foreach ($locales as $localeCode => $properties) {
            $rules["{$localeCode}.company_name"] = 'nullable';
            $rules["{$localeCode}.bio"] = 'nullable';


        }
        $request->validate($rules);
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


        if(isset($subspecialties))
        {
            ConsultingCompanySub::where('service_company_id',$id)->delete();
            for($i=0;$i<sizeof($subspecialties);$i++)
            {
                ConsultingCompanySub::create([
                    'service_company_id' => $id ,
                    'subspecialty_id' => $subspecialties[$i],
                ]);
            }
        }






        return redirect()->route('ConsultingServiceCompany.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $registerConsultingServiceCompany = ServiceCompany::findOrFail($id);
        $registerConsultingServiceCompany->clearMediaCollection('commercial_registration_certificate');
        $registerConsultingServiceCompany->clearMediaCollection('vat_certificate');
        $registerConsultingServiceCompany->clearMediaCollection('social_insurance_certificate');
        $registerConsultingServiceCompany->clearMediaCollection('chamber_of_commerce_certificate');
        $registerConsultingServiceCompany->clearMediaCollection('company_profile');
        $registerConsultingServiceCompany->delete();
        return redirect()->route('ConsultingServiceCompany.index');

    }

    public function getSubspecialties($specialty_id)
    {
        $subspecialties = Subspecialty::where('specialty_id', $specialty_id)->get();
        return response()->json($subspecialties);
    }



}