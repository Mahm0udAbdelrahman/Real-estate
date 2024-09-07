<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Models\Specialty;
use App\Models\Subspecialty;
use Illuminate\Http\Request;
use App\Models\ManagerComSub;
use App\Models\ManagerCompany;
use App\Http\Controllers\Controller;
use App\Models\SubspecialtyTranslation;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ManagerCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $register_companies = ManagerCompany::latest()->get();
        $lang=app()->getLocale();
        return view('admin.dashboard.ManagerCompany.index', compact('register_companies','lang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specialties = Specialty::all();
        return view('admin.dashboard.ManagerCompany.create',compact('specialties'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'email' => "required|email|unique:manager_companies,email",
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
            'subspecialty_id' => 'required',
            'status' => 'required|string',
        ];

        foreach ($locales as $localeCode => $properties) {
            $rules["{$localeCode}.company_name"] = 'nullable';
            $rules["{$localeCode}.bio"] = 'nullable';


        }

        $validation = $request->validate($rules);

        $allDataExceptFiles = $request->except(['commercial_registration_certificate', 'vat_certificate', 'social_insurance_certificate', 'chamber_of_commerce_certificate', 'company_profile']);
        $ManagerCompany = ManagerCompany::create($allDataExceptFiles);

        // تحميل وتحديث الشعار إذا تم إرسال ملف الشعار
        if ($request->hasFile('commercial_registration_certificate')) {
            $uploadedcommercial_registration_certificate = $ManagerCompany->addMediaFromRequest('commercial_registration_certificate')->toMediaCollection('commercial_registration_certificate');
            $ManagerCompany->update(['commercial_registration_certificate' => $uploadedcommercial_registration_certificate->getUrl()]);
        }

        // تحميل وتحديث الصورة إذا تم إرسال ملف الصورة
        if ($request->hasFile('vat_certificate')) {
            $uploadedvat_certificate = $ManagerCompany->addMediaFromRequest('vat_certificate')->toMediaCollection('vat_certificate');
            $ManagerCompany->update(['vat_certificate' => $uploadedvat_certificate->getUrl()]);
        }
        if ($request->hasFile('social_insurance_certificate')) {
            $uploadedsocial_insurance_certificate = $ManagerCompany->addMediaFromRequest('social_insurance_certificate')->toMediaCollection('social_insurance_certificate');
            $ManagerCompany->update(['social_insurance_certificate' => $uploadedsocial_insurance_certificate->getUrl()]);
        }

        if ($request->hasFile('chamber_of_commerce_certificate')) {
            $uploadedchamber_of_commerce_certificate = $ManagerCompany->addMediaFromRequest('chamber_of_commerce_certificate')->toMediaCollection('chamber_of_commerce_certificate');
            $ManagerCompany->update(['chamber_of_commerce_certificate' => $uploadedchamber_of_commerce_certificate->getUrl()]);
        }


        if ($request->hasFile('company_profile')) {
            $uploadedcompany_profile = $ManagerCompany->addMediaFromRequest('company_profile')->toMediaCollection('company_profile');
            $ManagerCompany->update(['company_profile' => $uploadedcompany_profile->getUrl()]);
        }
        $subspecialties=$request->subspecialty_id;
        for($i=0;$i<sizeof($subspecialties);$i++)
        {
            ManagerComSub::create([
                'manager_company_id'=>$ManagerCompany->id,
                'subspecialty_id'=>$subspecialties[$i]
            ]);
        }
        return redirect()->route('ManagerCompany.index');
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
        $registerManagerCompany = ManagerCompany::findOrFail($id);
        $specialties = Specialty::all();

        // $selectedSpecialtyId = $registerConsultingServiceCompany->specialty_id;
        $lang=app()->getLocale();
        // $selectedSubspecialtyId = $registerConsultingServiceCompany->subspecialty_id;
        $subspecialtyIds = ManagerComSub::where('manager_company_id',$registerManagerCompany->id)->pluck('subspecialty_id');

        $subs = SubspecialtyTranslation::whereIn('subspecialty_id', $subspecialtyIds)->where('locale', $lang)->get();

        $companySubs=ManagerComSub::where('manager_company_id',$id)->get();
        return view('admin.dashboard.ManagerCompany.edit', compact('registerManagerCompany','specialties','subspecialtyIds','subs', 'companySubs' ));

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


        if(isset($subspecialties))
        {
            ManagerComSub::where('manager_company_id',$id)->delete();
            for($i=0;$i<sizeof($subspecialties);$i++)
            {
                ManagerComSub::create([
                    'manager_company_id' => $id ,
                    'subspecialty_id' => $subspecialties[$i],
                ]);
            }
        }


        return redirect()->route('ManagerCompany.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $registerManagerCompany = ManagerCompany::findOrFail($id);
        $registerManagerCompany->clearMediaCollection('commercial_registration_certificate');
        $registerManagerCompany->clearMediaCollection('vat_certificate');
        $registerManagerCompany->clearMediaCollection('social_insurance_certificate');
        $registerManagerCompany->clearMediaCollection('chamber_of_commerce_certificate');
        $registerManagerCompany->clearMediaCollection('company_profile');
        $registerManagerCompany->delete();
        return redirect()->route('ManagerCompany.index');

    }


    public function getSubspecialties($specialty_id)
    {
        $subspecialties = Subspecialty::where('specialty_id', $specialty_id)->get();
        return response()->json($subspecialties);
    }


    public function getServices($subspecialty_id)
    {
        $services = Service::where('subspecialty_id', $subspecialty_id)->get();
        return response()->json($services);
    }
}