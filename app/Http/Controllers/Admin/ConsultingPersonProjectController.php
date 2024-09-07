<?php

namespace App\Http\Controllers\Admin;

use App\Models\OtherProject;
use Illuminate\Http\Request;
use App\Models\ServicePerson;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ConsultingPersonProjectController extends Controller
{
    public function index()
    {
        $consultings =  ServicePerson::pluck('id')->first(); 
        $Personprojects = OtherProject::where('service_person_id',$consultings)->latest()->get();
        return view('admin.dashboard.consulting_person_projects.index', compact('Personprojects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('admin.dashboard.consulting_person_projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules =
            [
                'date' => 'required|string',
                'status' => 'required|string',
            ];

        foreach ($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.title"] = 'nullable';
            $rules["{$localeCode}.content"] = 'nullable';
        }

        $request->validate($rules);

        $allDataExceptImages = $request->except(['logo', 'image']);



        $consultings =  ServicePerson::pluck('id')->first(); 
        if ($consultings != null) {

            $allDataExceptImages['service_person_id'] = $consultings;
            $project = OtherProject::create($allDataExceptImages);
              // تحميل وتحديث الشعار إذا تم إرسال ملف الشعار
        if ($request->hasFile('logo')) {
            $uploadedLogo = $project->addMediaFromRequest('logo')->toMediaCollection('logo');
            $project->update(['logo' => $uploadedLogo->getUrl()]);
        }



        if ($request->hasFile('image')) {
            $imageUrls = [];
            foreach ($request->file('image') as $image) {
                $uploadedImage = $project->addMedia($image)->toMediaCollection('image');
                $imageUrls[] = $uploadedImage->getUrl();
            }

            // يمكنك تخزين الروابط كأرشف فردي أو مصفوفة JSON في عمود قاعدة البيانات
            $project->update(['images' => json_encode($imageUrls)]);
        }


        return redirect()->route('consulting_person_projects.index');
        }else{
             
        return redirect()->back()->with('success','Plz Register consulting person!');

        }
 
      
    }

    /**
     * Display the specified resource.
     */
    public function show(OtherProject $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $project = OtherProject::findOrFail($id);

        return view('admin.dashboard.consulting_person_projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [


            'date' => 'required|string',
            'status' => 'required|string',
        ];

        foreach ($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.title"] = 'nullable';
            $rules["{$localeCode}.content"] = ' nullable';
        }

        $request->validate($rules);
        $allDataExceptImages = $request->except(['logo', 'image']);
        $project = OtherProject::findOrFail($id);
        $project->update($allDataExceptImages);



        if ($request->hasFile('logo')) {
            // حذف الوسائط القديمة للشعار
            $oldLogo = $project->getFirstMedia('logo');
            if ($oldLogo) {
                $oldLogo->delete();
            }

            // رفع الشعار الجديد
            $uploadedLogo = $project->addMediaFromRequest('logo')->toMediaCollection('logo');

            // تحديث حقل الشعار في قاعدة البيانات
            $project->update([
                'logo' => $uploadedLogo->getUrl(),
            ]);
        }



        if ($request->hasFile('image')) {
            // حذف الوسائط القديمة
            $project->clearMediaCollection('image');

            $imageUrls = [];
            foreach ($request->file('image') as $image) {
                $uploadedImage = $project->addMedia($image)->toMediaCollection('image');
                $imageUrls[] = $uploadedImage->getUrl();
            }

            // تحديث حقل الصورة في قاعدة البيانات
            $project->update([
                'images' => json_encode($imageUrls),
            ]);
        }








        return redirect()->route('consulting_person_projects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $project = OtherProject::findOrFail($id);
        $project->clearMediaCollection('logo');
        $project->clearMediaCollection('image');
        $project->delete();
        return redirect()->route('consulting_person_projects.index');
    }
}
