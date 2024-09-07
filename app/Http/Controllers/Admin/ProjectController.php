<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::latest()->get();
        return view('admin.dashboard.projects.index',compact('projects'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.projects.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $locales = LaravelLocalization::getSupportedLocales();

            $rules =
            [
                'date'=> 'required|string',
                'status'=> 'required|string',
            ];

            foreach($locales  as $localeCode => $properties) {
                $rules["{$localeCode}.title"] = 'nullable';
                $rules["{$localeCode}.content"] = 'nullable';

            }

            $request->validate($rules);

        $allDataExceptImages = $request->except(['logo','image']);
        $project = Project::create($allDataExceptImages);

        // تحميل وتحديث الشعار إذا تم إرسال ملف الشعار
        if ($request->hasFile('logo')) {
            $uploadedLogo = $project->addMediaFromRequest('logo')->toMediaCollection('logo');
            $project->update(['logo' => $uploadedLogo->getUrl()]);
        }

        // تحميل وتحديث الصورة إذا تم إرسال ملف الصورة
        // if ($request->hasFile('image')) {
        //     $uploadedImage = $project->addMediaFromRequest('image')->toMediaCollection('image');
        //     $project->update(['image' => $uploadedImage->getUrl()]);
        // }

        if ($request->hasFile('image')) {
            $imageUrls = [];
            foreach ($request->file('image') as $image) {
                $uploadedImage = $project->addMedia($image)->toMediaCollection('image');
                $imageUrls[] = $uploadedImage->getUrl();
            }

            // يمكنك تخزين الروابط كأرشف فردي أو مصفوفة JSON في عمود قاعدة البيانات
            $project->update(['images' => json_encode($imageUrls)]);
        }


        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);

        return view('admin.dashboard.projects.edit',compact('project'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [


            'date'=> 'required|string',
            'status'=> 'required|string',
        ];

        foreach($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.title"] = 'nullable';
            $rules["{$localeCode}.content"] = ' nullable';

        }

        $request->validate($rules);
        $allDataExceptImages = $request->except(['logo','image']);
        $project = Project::findOrFail($id);
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

        // if ($request->hasFile('image')) {
        //     // حذف الوسائط القديمة للصورة
        //     $oldImage = $project->getFirstMedia('image');
        //     if ($oldImage) {
        //         $oldImage->delete();
        //     }

        //     // رفع الصورة الجديدة
        //     $uploadedImage = $project->addMediaFromRequest('image')->toMediaCollection('image');

        //     // تحديث حقل الصورة في قاعدة البيانات
        //     $project->update([
        //         'image' => $uploadedImage->getUrl(),
        //     ]);
        // }


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








        return redirect()->route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->clearMediaCollection('logo');
        $project->clearMediaCollection('image');
        $project->delete();
        return redirect()->route('projects.index');
    }

}