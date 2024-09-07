<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use App\Models\Language;
use App\Models\Translation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Countries\StoreRequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $countries = Country::latest()->get();
        // $session=session()->get('locale');
        // $lang= Language::where('abbreviations',$session)->first();

        // return view('admin.dashboard.countries.index',compact('countries','session','lang'));

        $countries = Country::latest()->get();
        return view('admin.dashboard.countries.index',compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        return view('admin.dashboard.countries.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {



        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'abbreviation'=> 'required|string',
            'code'=> 'required|string',
             'status'=> 'required|string',
        ];

        foreach($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'required|string';


        }

        $request->validate($rules);

            $allDataExceptImages = $request->except('flag');
            $country = Country::create($allDataExceptImages);
            if($request->file('flag'))
            {
                $uploadedlogo = $country->addMediaFromRequest('flag')->toMediaCollection('flag');
                $country->update([
                    'flag' => $uploadedlogo->getUrl()
                ]);
            }





        return redirect()->route('countries.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $country = Country::findOrFail($id);
        $translations = Translation::where('model_type','Country')->where('model_id',$country->id)->get();
        $language = Language::all();

        return view('admin.dashboard.countries.edit',compact('country','translations','language'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Country  $country)
    {


        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'abbreviation'=> 'required|string',
            'code'=> 'required|string',
             'status'=> 'required|string',
        ];

        foreach($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'required|string';

        }

        $request->validate($rules);

        $allCategoriesWithoutImages = $request->except(['flag']);
        $country->update($allCategoriesWithoutImages);

        if($request->file('flag')) {
            $oldData = $country->media;
            $oldData[0]->delete();
            $uploadedimage = $country->addMediaFromRequest('flag')
            ->toMediaCollection('flag');

            $country->update([
                'flag' => $uploadedimage->getUrl()
            ]);

        }


        return redirect()->route('countries.index');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        $country->clearMediaCollection('flag');
        $country->delete();
        return redirect()->route('countries.index');

   }
}