<?php

namespace App\Http\Controllers\Admin;

use App\Models\Conference;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ConferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $conferences = Conference::latest()->get();
        return view('admin.dashboard.conferences.index',compact('conferences'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.conferences.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $locales = LaravelLocalization::getSupportedLocales();

            $rules = [
                'date' => 'required|string',
                'location' => 'required|string',
                'time_from' => 'required|string',
                'time_to' => 'required|string',
                'status'=> 'required|string',
            ];

            foreach($locales  as $localeCode => $properties) {
                $rules["{$localeCode}.name"] = 'required|string';
                $rules["{$localeCode}.about"] = 'required|string';

            }

            $request->validate($rules);

        $allDataExceptImages = $request->except(['image']);
        $allDataExceptImages['admin_id'] = Auth::guard('admin')->user()->name;
        $conference = Conference::create($allDataExceptImages);



        // تحميل وتحديث الصورة إذا تم إرسال ملف الصورة
        if ($request->hasFile('image')) {
            $uploadedImage = $conference->addMediaFromRequest('image')->toMediaCollection('image');
            $conference->update(['image' => $uploadedImage->getUrl()]);
        }

        return redirect()->route('conferences.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Conference $conference)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $conference = Conference::findOrFail($id);
        return view('admin.dashboard.conferences.edit',compact('conference'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'date' => 'required|string',
            'location' => 'required|string',
            'time_from' => 'required|string',
            'time_to' => 'required|string',
            'status'=> 'required|string',
        ];

        foreach($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'required|string';
            $rules["{$localeCode}.about"] = 'required|string';

        }

        $request->validate($rules);
        $allDataExceptImages = $request->except(['image']);
        $allDataExceptImages['admin_id'] = Auth::guard('admin')->user()->name;
        $conference = Conference::findOrFail($id);
        $conference->update($allDataExceptImages);





        if ($request->hasFile('image')) {
            // حذف الوسائط القديمة للصورة
            $oldImage = $conference->getFirstMedia('image');
            if ($oldImage) {
                $oldImage->delete();
            }

            // رفع الصورة الجديدة
            $uploadedImage = $conference->addMediaFromRequest('image')->toMediaCollection('image');

            // تحديث حقل الصورة في قاعدة البيانات
            $conference->update([
                'image' => $uploadedImage->getUrl(),
            ]);
        }

        return redirect()->route('conferences.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conference $conference)
    {
        $conference->clearMediaCollection('image');
        $conference->delete();
        return redirect()->route('conferences.index');
    }
}