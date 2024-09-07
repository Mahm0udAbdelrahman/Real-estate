<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::latest()->get();
        return view('admin.dashboard.events.index',compact('events'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.events.create');

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
        $event = Event::create($allDataExceptImages);



        // تحميل وتحديث الصورة إذا تم إرسال ملف الصورة
        if ($request->hasFile('image')) {
            $uploadedImage = $event->addMediaFromRequest('image')->toMediaCollection('image');
            $event->update(['image' => $uploadedImage->getUrl()]);
        }

        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.dashboard.events.edit',compact('event'));

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
        $event = Event::findOrFail($id);
        $event->update($allDataExceptImages);





        if ($request->hasFile('image')) {
            // حذف الوسائط القديمة للصورة
            $oldImage = $event->getFirstMedia('image');
            if ($oldImage) {
                $oldImage->delete();
            }

            // رفع الصورة الجديدة
            $uploadedImage = $event->addMediaFromRequest('image')->toMediaCollection('image');

            // تحديث حقل الصورة في قاعدة البيانات
            $event->update([
                'image' => $uploadedImage->getUrl(),
            ]);
        }

        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->clearMediaCollection('image');
        $event->delete();
        return redirect()->route('events.index');
    }
}