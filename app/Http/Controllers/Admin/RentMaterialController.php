<?php

namespace App\Http\Controllers\Admin;

use App\Models\RentMaterial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class RentMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $RentMaterials = RentMaterial::latest()->get();
        return view('admin.dashboard.RentMaterial.index',compact('RentMaterials'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.RentMaterial.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $locales = LaravelLocalization::getSupportedLocales();

            $rules = [
                'price' => 'required|string',
                'status'=> 'required|string',
            ];

            foreach($locales  as $localeCode => $properties) {
                $rules["{$localeCode}.name"] = 'nullable';
                $rules["{$localeCode}.bio"] = 'nullable';

            }

            $request->validate($rules);

        $allDataExceptImages = $request->except(['image']);
        $RentMaterial = RentMaterial::create($allDataExceptImages);


        if ($request->hasFile('logo')) {
            $uploadedLogo = $RentMaterial->addMediaFromRequest('logo')->toMediaCollection('logo');
            $RentMaterial->update(['logo' => $uploadedLogo->getUrl()]);
        }


        if ($request->hasFile('image')) {
            $imageUrls = [];
            foreach ($request->file('image') as $image) {
                $uploadedImage = $RentMaterial->addMedia($image)->toMediaCollection('image');
                $imageUrls[] = $uploadedImage->getUrl();
            }

            // يمكنك تخزين الروابط كأرشف فردي أو مصفوفة JSON في عمود قاعدة البيانات
            $RentMaterial->update(['images' => json_encode($imageUrls)]);
        }


        return redirect()->route('RentMaterial.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $RentMaterial = RentMaterial::findOrFail($id);

        return view('admin.dashboard.RentMaterial.edit',compact('RentMaterial'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
           'price' => 'required|string',
            'status'=> 'required|string',
        ];

        foreach($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'nullable';
            $rules["{$localeCode}.bio"] = 'nullable';

        }

        $request->validate($rules);
        $allDataExceptImages = $request->except(['logo','image']);
        $RentMaterial = RentMaterial::findOrFail($id);
        $RentMaterial->update($allDataExceptImages);





        if ($request->hasFile('logo')) {
            // حذف الوسائط القديمة للشعار
            $oldLogo = $RentMaterial->getFirstMedia('logo');
            if ($oldLogo) {
                $oldLogo->delete();
            }

            // رفع الشعار الجديد
            $uploadedLogo = $RentMaterial->addMediaFromRequest('logo')->toMediaCollection('logo');

            // تحديث حقل الشعار في قاعدة البيانات
            $RentMaterial->update([
                'logo' => $uploadedLogo->getUrl(),
            ]);
        }




        if ($request->hasFile('image')) {
            // حذف الوسائط القديمة
            $RentMaterial->clearMediaCollection('image');

            $imageUrls = [];
            foreach ($request->file('image') as $image) {
                $uploadedImage = $RentMaterial->addMedia($image)->toMediaCollection('image');
                $imageUrls[] = $uploadedImage->getUrl();
            }

            // تحديث حقل الصورة في قاعدة البيانات
            $RentMaterial->update([
                'images' => json_encode($imageUrls),
            ]);
        }









        return redirect()->route('RentMaterial.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RentMaterial $RentMaterial)
    {
        $RentMaterial->clearMediaCollection('image');
        $RentMaterial->clearMediaCollection('logo');
         $RentMaterial->delete();
        return redirect()->route('RentMaterial.index');
    }
}