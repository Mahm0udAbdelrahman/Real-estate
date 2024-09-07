<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::latest()->get();
        return view('admin.dashboard.settings.index',compact('settings'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.settings.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $locales = LaravelLocalization::getSupportedLocales();

            $rules = [
                'language'=> 'required|string',
                'logo'=> 'required|string',
                'favicon'=> 'required|string',
                'phone'=> 'required|string',
                'email'=> 'required|string',
                'whatsapp'=> 'required|string',
                'facebook'=> 'required|string',
                'twitter'=> 'required|string',
                'Instagram'=> 'required|string',
                'youtube'=> 'required|string',
                'status'=> 'required|string',
            ];

            foreach($locales  as $localeCode => $properties) {
                $rules["{$localeCode}.name"] = 'required|string';
                $rules["{$localeCode}.description"] = 'required|string';
                $rules["{$localeCode}.words_guide"] = 'required|string';
                $rules["{$localeCode}.about"] = 'required|string';
                $rules["{$localeCode}.privacy"] = 'required|string';
                $rules["{$localeCode}.terms"] = 'required|string';

            }

            $request->validate($rules);

        $allDataExceptImages = $request->except(['logo','favicon']);
        $setting = Setting::create($allDataExceptImages);
        if($request->file('logo'))
        {
            $uploadedlogo = $setting->addMediaFromRequest('logo')->toMediaCollection('logo');
            $setting->update([
                'logo' => $uploadedlogo->getUrl()
            ]);
        }
        if($request->file('favicon'))
        {
            $uploadedfavicon = $setting->addMediaFromRequest('favicon')->toMediaCollection('favicon');
            $setting->update([
                'favicon' => $uploadedfavicon->getUrl()
            ]);
        }

        return redirect()->route('settings.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        return view('admin.dashboard.settings.edit',compact('setting'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'language'=> 'required|string',
            'logo'=> 'required|string',
            'favicon'=> 'required|string',
            'phone'=> 'required|string',
            'email'=> 'required|string',
            'whatsapp'=> 'required|string',
            'facebook'=> 'required|string',
            'twitter'=> 'required|string',
            'instagram'=> 'required|string',
            'youtube'=> 'required|string',
            'status'=> 'required|string',
        ];

        foreach($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'required|string';
            $rules["{$localeCode}.description"] = 'required|string';
            $rules["{$localeCode}.words_guide"] = 'required|string';
            $rules["{$localeCode}.about"] = 'required|string';
            $rules["{$localeCode}.privacy"] = 'required|string';
            $rules["{$localeCode}.terms"] = 'required|string';
        }

        $request->validate($rules);
        $allDataExceptImages = $request->except(['logo','favicon']);
        $setting->update($allDataExceptImages);
        if($request->file('logo'))
        {
            $oldLogo = $setting->media;
            $oldLogo[0]->delete();
            $uploadedlogo = $setting->addMediaFromRequest('logo')->toMediaCollection('logo');
            $setting->update([
                'logo' => $uploadedlogo->getUrl()
            ]);
        }
        if($request->file('favicon'))
        {
            $oldLogo = $setting->media;
            $oldLogo[1]->delete();
            $uploadedfavicon = $setting->addMediaFromRequest('favicon')->toMediaCollection('favicon');
            $setting->update([
                'favicon' => $uploadedfavicon->getUrl()
            ]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {

        $setting->delete();
        return redirect()->route('settings.index');
    }

    public function restore(Setting $setting)
    {
        $setting->restore();
       return redirect()->route('settings.index');


    }
    public function erase(Setting $setting)
    {
        $setting->clearMediaCollection('logo');
        $setting->clearMediaCollection('favicon');
        $setting->forceDelete();
       return redirect()->route('settings.index');

    }

    public function switchLang($lang)
    {
        App::setLocale($lang);
        Session::put('locale', $lang);
        App::getlocale();

        return redirect()->back();
    }
}