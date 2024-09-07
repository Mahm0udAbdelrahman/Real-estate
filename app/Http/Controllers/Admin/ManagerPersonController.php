<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Models\Specialty;
use App\Models\Subspecialty;
use Illuminate\Http\Request;
use App\Models\ManagerPerson;
use App\Models\ManagerPersonSub;
use App\Http\Controllers\Controller;
use App\Models\SubspecialtyTranslation;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ManagerPersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $register_persons = ManagerPerson::latest()->get();
        $lang=app()->getLocale();
        return view('admin.dashboard.ManagerPerson.index', compact('register_persons','lang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specialties = Specialty::all();
        return view('admin.dashboard.ManagerPerson.create',compact('specialties'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
           'email' => "required|email|unique:manager_persons,email",
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
        $ManagerPerson = ManagerPerson::create($allDataExceptFiles);

        // تحميل وتحديث الشعار إذا تم إرسال ملف الشعار
        if ($request->hasFile('national_id')) {
            $uploadednational_id = $ManagerPerson->addMediaFromRequest('national_id')->toMediaCollection('national_id');
            $ManagerPerson->update(['national_id' => $uploadednational_id->getUrl()]);
        }

        // تحميل وتحديث الصورة إذا تم إرسال ملف الصورة
        if ($request->hasFile('freelance_license')) {
            $uploadedfreelance_license = $ManagerPerson->addMediaFromRequest('freelance_license')->toMediaCollection('freelance_license');
            $ManagerPerson->update(['freelance_license' => $uploadedfreelance_license->getUrl()]);
        }
        if ($request->hasFile('cv')) {
            $uploadedcv = $ManagerPerson->addMediaFromRequest('cv')->toMediaCollection('cv');
            $ManagerPerson->update(['cv' => $uploadedcv->getUrl()]);
        }

        if ($request->hasFile('latest_academic_degree')) {
            $uploadedlatest_academic_degree = $ManagerPerson->addMediaFromRequest('latest_academic_degree')->toMediaCollection('latest_academic_degree');
            $ManagerPerson->update(['latest_academic_degree' => $uploadedlatest_academic_degree->getUrl()]);
        }


        if ($request->hasFile('profile_photo')) {
            $uploadedprofile_photo = $ManagerPerson->addMediaFromRequest('profile_photo')->toMediaCollection('profile_photo');
            $ManagerPerson->update(['profile_photo' => $uploadedprofile_photo->getUrl()]);
        }
        $subspecialty = $request->subspecialty_id;
        for($i=0; $i<sizeof($subspecialty) ;$i++)
        {
            ManagerPersonSub::create([
                'manager_person_id' => $ManagerPerson->id ,
                'subspecialty_id' =>  $subspecialty[$i],

            ]);

        }


        return redirect()->route('ManagerPerson.index');
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
        $registerManagerPerson = ManagerPerson::findOrFail($id);
        $specialties = Specialty::all();
        $lang=app()->getLocale();

        $subspecialtyIds = ManagerPersonSub::where('manager_person_id',$registerManagerPerson->id)->pluck('subspecialty_id');

        $subs = SubspecialtyTranslation::whereIn('subspecialty_id', $subspecialtyIds)->where('locale', $lang)->get();

        $personSubs = ManagerPersonSub::where('manager_person_id',$id)->get();
        return view('admin.dashboard.ManagerPerson.edit', compact('registerManagerPerson','specialties','subs','personSubs'));

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
            'age' => 'required|string',
            'year_of_experience' => 'required|string',
            'national_id' => 'file|max:2048',
            'freelance_license' => 'file|max:2048',
            'cv' => 'file|max:2048',
            'latest_academic_degree' => 'file|max:2048',
            'profile_photo' => 'file|max:2048',
            'specialty_id' => 'required|string',
            'subspecialty_id' => 'required|array',
            'status' => 'required|string',
        ];

        foreach ($locales as $localeCode => $properties) {
            $rules["{$localeCode}.full_name"] = 'nullable';
            $rules["{$localeCode}.academic_degree"] = 'nullable';

        }
        $request->validate($rules);
        $allDataExceptFiles = $request->except(['national_id', 'freelance_license', 'cv', 'latest_academic_degree', 'profile_photo']);

        $ManagerPerson = ManagerPerson::findOrFail($id);
        $ManagerPerson->update($allDataExceptFiles);



        if ($request->hasFile('national_id')) {
            // حذف الوسائط القديمة للشعار
            $oldnational_id = $ManagerPerson->getFirstMedia('national_id');
            if ($oldnational_id) {
                $oldnational_id->delete();
            }

            // رفع الشعار الجديد
            $uploadednational_id = $ManagerPerson->addMediaFromRequest('national_id')->toMediaCollection('national_id');

            // تحديث حقل الشعار في قاعدة البيانات
            $ManagerPerson->update([
                'national_id' => $uploadednational_id->getUrl(),
            ]);
        }

        if ($request->hasFile('freelance_license')) {
            // حذف الوسائط القديمة للصورة
            $oldfreelance_license = $ManagerPerson->getFirstMedia('freelance_license');
            if ($oldfreelance_license) {
                $oldfreelance_license->delete();
            }

            // رفع الصورة الجديدة
            $uploadedfreelance_license = $ManagerPerson->addMediaFromRequest('freelance_license')->toMediaCollection('freelance_license');

            // تحديث حقل الصورة في قاعدة البيانات
            $ManagerPerson->update([
                'freelance_license' => $uploadedfreelance_license->getUrl(),
            ]);
        }

        if ($request->hasFile('cv')) {
            // حذف الوسائط القديمة للصورة
            $oldcv = $ManagerPerson->getFirstMedia('cv');
            if ($oldcv) {
                $oldcv->delete();
            }

            // رفع الصورة الجديدة
            $uploadedcv = $ManagerPerson->addMediaFromRequest('cv')->toMediaCollection('cv');

            // تحديث حقل الصورة في قاعدة البيانات
            $ManagerPerson->update([
                'cv' => $uploadedcv->getUrl(),
            ]);
        }

        if ($request->hasFile('latest_academic_degree')) {
            // حذف الوسائط القديمة للصورة
            $oldlatest_academic_degree = $ManagerPerson->getFirstMedia('latest_academic_degree');
            if ($oldlatest_academic_degree) {
                $oldlatest_academic_degree->delete();
            }

            // رفع الصورة الجديدة
            $uploadedlatest_academic_degree = $ManagerPerson->addMediaFromRequest('latest_academic_degree')->toMediaCollection('latest_academic_degree');

            // تحديث حقل الصورة في قاعدة البيانات
            $ManagerPerson->update([
                'latest_academic_degree' => $uploadedlatest_academic_degree->getUrl(),
            ]);
        }

        if ($request->hasFile('profile_photo')) {
            // حذف الوسائط القديمة للصورة
            $oldprofile_photo = $ManagerPerson->getFirstMedia('profile_photo');
            if ($oldprofile_photo) {
                $oldprofile_photo->delete();
            }

            // رفع الصورة الجديدة
            $uploadedprofile_photo = $ManagerPerson->addMediaFromRequest('profile_photo')->toMediaCollection('profile_photo');

            // تحديث حقل الصورة في قاعدة البيانات
            $ManagerPerson->update([
                'profile_photo' => $uploadedprofile_photo->getUrl(),
            ]);
        }

        $subspecialties = $request->subspecialty_id;


        if(isset($subspecialties))
        {
            ManagerPersonSub::where('manager_person_id',$id)->delete();
            for($i=0;$i<sizeof($subspecialties);$i++)
            {
                ManagerPersonSub::create([
                    'manager_person_id' => $id ,
                    'subspecialty_id' => $subspecialties[$i],
                ]);
            }
        }

        return redirect()->route('ManagerPerson.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $registerManagerPerson = ManagerPerson::findOrFail($id);
        $registerManagerPerson->clearMediaCollection('national_id');
        $registerManagerPerson->clearMediaCollection('freelance_license');
        $registerManagerPerson->clearMediaCollection('cv');
        $registerManagerPerson->clearMediaCollection('latest_academic_degree');
        $registerManagerPerson->clearMediaCollection('profile_photo');
        $registerManagerPerson->delete();
        return redirect()->route('ManagerPerson.index');

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