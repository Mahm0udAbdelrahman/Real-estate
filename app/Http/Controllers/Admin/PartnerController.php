<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Country;
use App\Models\Partner;
use App\Models\Specialty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partners = Partner::latest()->get();
        return view('admin.dashboard.partners.index',compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        $countries = Country::all();
        $specialties = Specialty::all();


        return view('admin.dashboard.partners.create',compact('countries','specialties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $locales = LaravelLocalization::getSupportedLocales();

        $rules =
        [
            'year_of_experience' => 'required|string',
            'email' => 'required|email|unique:partners,email',
            'phone'=> 'required|string',
            'location' => 'required|string',
            'country_id'=> 'required|string',
            'city_id'=> 'required|string',
            'specialty_id'=> 'required|string',
            'status'=> 'required|string',

        ];

        foreach($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'nullable';

        }

        $request->validate($rules);

            $allDataExceptImages = $request->except('image');
            $allDataExceptImages['membership_no'] = rand(10000000,99999999);
            $partner = Partner::create($allDataExceptImages);
            if($request->file('image'))
            {
                $uploadedlogo = $partner->addMediaFromRequest('image')->toMediaCollection('image');
                $partner->update([
                    'image' => $uploadedlogo->getUrl()
                ]);
            }

        return redirect()->route('partners.index');
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
    public function edit($id)
    {
        $partner = Partner::find($id);
        $countries = Country::all();
        $specialties = Specialty::all();
        $selectedCountryId = $partner->country_id;
        $selectedCityId = $partner->city_id;
        return view('admin.dashboard.partners.edit',compact('partner','specialties','countries','selectedCountryId','selectedCityId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {



        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'year_of_experience' => 'required|string',
            'email' => 'required|email',
            'phone'=> 'required|string',
            'location' => 'required|string',
            'specialty_id'=> 'required|string',
            'country_id'=> 'required|string',
            'city_id'=> 'required|string',
            'status'=> 'required|string',
        ];

        foreach($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'nullable';


        }

        $request->validate($rules);

        $allCategoriesWithoutImages = $request->except(['image']);
       
        $partner = Partner::find($id);
        $partner->update($allCategoriesWithoutImages);

        if ($request->hasFile('image')) {
            // حذف الوسائط القديمة للشعار
            $oldimage = $partner->getFirstMedia('image');
            if ($oldimage) {
                $oldimage->delete();
            }

            // رفع الشعار الجديد
            $uploadedimage = $partner->addMediaFromRequest('image')->toMediaCollection('image');

            // تحديث حقل الشعار في قاعدة البيانات
            $partner->update([
                'image' => $uploadedimage->getUrl(),
            ]);
        }
        return redirect()->route('partners.index');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $partner = Partner::find($id);
        $partner->clearMediaCollection('image');
        $partner->delete();
       return redirect()->route('partners.index');
    }

    public function getCities($country_id)
    {
        $cities = City::where('country_id', $country_id)->get();
        return response()->json($cities);
    }
}
