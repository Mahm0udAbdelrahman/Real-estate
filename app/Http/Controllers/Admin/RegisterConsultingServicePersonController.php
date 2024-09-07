<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Models\Specialty;
use App\Models\Subspecialty;
use Illuminate\Http\Request;
use App\Models\ServicePerson;
use App\Models\ConsultingPersonSub;
use App\Http\Controllers\Controller;
use App\Models\SubspecialtyTranslation;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class RegisterConsultingServicePersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $register_persons = ServicePerson::latest()->get();
        $lang = app()->getLocale();
        return view('admin.dashboard.ConsultingServicePerson.index', compact('register_persons', 'lang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specialties = Specialty::all();
        return view('admin.dashboard.ConsultingServicePerson.create', compact('specialties'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'email' => "required|email|unique:service_persons,email",
            'phone' => 'required|string',
            'age' => 'required|string',
            'year_of_experience' => 'required|string',
            'national_id' => 'required|file|max:2048',
            'freelance_license' => 'required|file|max:2048',
            'cv' => 'required|file|max:2048',
            'latest_academic_degree' => 'required|file|max:2048',
            'profile_photo' => 'required|file|max:2048',
            'specialty_id' => 'required|string',
            'subspecialty_id' => 'required',
            'status' => 'required|string',
        ];

        foreach ($locales as $localeCode => $properties) {
            $rules["{$localeCode}.full_name"] = 'nullable';
            $rules["{$localeCode}.academic_degree"] = 'nullable';


        }

        $validation = $request->validate($rules);

        $allDataExceptFiles = $request->except(['national_id', 'freelance_license', 'cv', 'latest_academic_degree', 'profile_photo']);
        $ServicePerson = ServicePerson::create($allDataExceptFiles);

        // تحميل وتحديث الشعار إذا تم إرسال ملف الشعار
        if ($request->hasFile('national_id')) {
            $uploadednational_id = $ServicePerson->addMediaFromRequest('national_id')->toMediaCollection('national_id');
            $ServicePerson->update(['national_id' => $uploadednational_id->getUrl()]);
        }

        // تحميل وتحديث الصورة إذا تم إرسال ملف الصورة
        if ($request->hasFile('freelance_license')) {
            $uploadedfreelance_license = $ServicePerson->addMediaFromRequest('freelance_license')->toMediaCollection('freelance_license');
            $ServicePerson->update(['freelance_license' => $uploadedfreelance_license->getUrl()]);
        }
        if ($request->hasFile('cv')) {
            $uploadedcv = $ServicePerson->addMediaFromRequest('cv')->toMediaCollection('cv');
            $ServicePerson->update(['cv' => $uploadedcv->getUrl()]);
        }

        if ($request->hasFile('latest_academic_degree')) {
            $uploadedlatest_academic_degree = $ServicePerson->addMediaFromRequest('latest_academic_degree')->toMediaCollection('latest_academic_degree');
            $ServicePerson->update(['latest_academic_degree' => $uploadedlatest_academic_degree->getUrl()]);
        }


        if ($request->hasFile('profile_photo')) {
            $uploadedprofile_photo = $ServicePerson->addMediaFromRequest('profile_photo')->toMediaCollection('profile_photo');
            $ServicePerson->update(['profile_photo' => $uploadedprofile_photo->getUrl()]);
        }

        $subspecialty = $request->subspecialty_id;
        for ($i = 0; $i < sizeof($subspecialty); $i++) {
            ConsultingPersonSub::create([
                'service_person_id' => $ServicePerson->id,
                'subspecialty_id' => $subspecialty[$i],
            ]);
        }


        return redirect()->route('ConsultingServicePerson.index');
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
        $registerConsultingServicePerson = ServicePerson::findOrFail($id);
        $specialties = Specialty::all();
        $lang = app()->getLocale();
        $subspecialtyIds = ConsultingPersonSub::where('service_person_id', $registerConsultingServicePerson->id)->pluck('subspecialty_id');

        $subs = SubspecialtyTranslation::whereIn('subspecialty_id', $subspecialtyIds)->where('locale', $lang)->get();

        $personSubs = ConsultingPersonSub::where('service_person_id', $id)->get();



        return view(
            'admin.dashboard.ConsultingServicePerson.edit',
            compact(
                'registerConsultingServicePerson',
                'specialties',

                'lang',
                'personSubs',
                'subs'
            )
        );

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'email' => 'required|string',
            'phone' => 'required|string',
            'age' => 'required|string',
            'year_of_experience' => 'required|string',
            'national_id' => 'file|max:2048',
            'specialty_id' => 'required|string',
            'subspecialty_id' => 'required|array',
            'freelance_license' => 'file|max:2048',
            'cv' => 'file|max:2048',
            'latest_academic_degree' => 'file|max:2048',
            'profile_photo' => 'file|max:2048',
            'status' => 'required|string',
        ];

        foreach ($locales as $localeCode => $properties) {
            $rules["{$localeCode}.full_name"] = 'nullable';
            $rules["{$localeCode}.academic_degree"] = 'nullable';

        }
        $request->validate($rules);
        $allDataExceptFiles = $request->except(['national_id', 'freelance_license', 'cv', 'latest_academic_degree', 'profile_photo']);

        $ServicePerson = ServicePerson::findOrFail($id);
        $ServicePerson->update($allDataExceptFiles);



        if ($request->hasFile('national_id')) {
            // حذف الوسائط القديمة للشعار
            $oldnational_id = $ServicePerson->getFirstMedia('national_id');
            if ($oldnational_id) {
                $oldnational_id->delete();
            }

            // رفع الشعار الجديد
            $uploadednational_id = $ServicePerson->addMediaFromRequest('national_id')->toMediaCollection('national_id');

            // تحديث حقل الشعار في قاعدة البيانات
            $ServicePerson->update([
                'national_id' => $uploadednational_id->getUrl(),
            ]);
        }

        if ($request->hasFile('freelance_license')) {
            // حذف الوسائط القديمة للصورة
            $oldfreelance_license = $ServicePerson->getFirstMedia('freelance_license');
            if ($oldfreelance_license) {
                $oldfreelance_license->delete();
            }

            // رفع الصورة الجديدة
            $uploadedfreelance_license = $ServicePerson->addMediaFromRequest('freelance_license')->toMediaCollection('freelance_license');

            // تحديث حقل الصورة في قاعدة البيانات
            $ServicePerson->update([
                'freelance_license' => $uploadedfreelance_license->getUrl(),
            ]);
        }

        if ($request->hasFile('cv')) {
            // حذف الوسائط القديمة للصورة
            $oldcv = $ServicePerson->getFirstMedia('cv');
            if ($oldcv) {
                $oldcv->delete();
            }

            // رفع الصورة الجديدة
            $uploadedcv = $ServicePerson->addMediaFromRequest('cv')->toMediaCollection('cv');

            // تحديث حقل الصورة في قاعدة البيانات
            $ServicePerson->update([
                'cv' => $uploadedcv->getUrl(),
            ]);
        }

        if ($request->hasFile('latest_academic_degree')) {
            // حذف الوسائط القديمة للصورة
            $oldlatest_academic_degree = $ServicePerson->getFirstMedia('latest_academic_degree');
            if ($oldlatest_academic_degree) {
                $oldlatest_academic_degree->delete();
            }

            // رفع الصورة الجديدة
            $uploadedlatest_academic_degree = $ServicePerson->addMediaFromRequest('latest_academic_degree')->toMediaCollection('latest_academic_degree');

            // تحديث حقل الصورة في قاعدة البيانات
            $ServicePerson->update([
                'latest_academic_degree' => $uploadedlatest_academic_degree->getUrl(),
            ]);
        }

        if ($request->hasFile('profile_photo')) {
            // حذف الوسائط القديمة للصورة
            $oldprofile_photo = $ServicePerson->getFirstMedia('profile_photo');
            if ($oldprofile_photo) {
                $oldprofile_photo->delete();
            }

            // رفع الصورة الجديدة
            $uploadedprofile_photo = $ServicePerson->addMediaFromRequest('profile_photo')->toMediaCollection('profile_photo');

            // تحديث حقل الصورة في قاعدة البيانات
            $ServicePerson->update([
                'profile_photo' => $uploadedprofile_photo->getUrl(),
            ]);
        }


        $subspecialties = $request->subspecialty_id;


        if (isset($subspecialties)) {
            ConsultingPersonSub::where('service_person_id', $id)->delete();
            for ($i = 0; $i < sizeof($subspecialties); $i++) {
                ConsultingPersonSub::create([
                    'service_person_id' => $id,
                    'subspecialty_id' => $subspecialties[$i],
                ]);
            }
        }




        return redirect()->route('ConsultingServicePerson.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $registerConsultingServicePerson = ServicePerson::findOrFail($id);
        $registerConsultingServicePerson->clearMediaCollection('national_id');
        $registerConsultingServicePerson->clearMediaCollection('freelance_license');
        $registerConsultingServicePerson->clearMediaCollection('cv');
        $registerConsultingServicePerson->clearMediaCollection('latest_academic_degree');
        $registerConsultingServicePerson->clearMediaCollection('profile_photo');
        $registerConsultingServicePerson->delete();
        return redirect()->route('ConsultingServicePerson.index');

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