<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use App\Models\Specialty;
use App\Models\Contractor;
use App\Models\Country;
use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ContractorCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contractors = Contractor::latest()->get();
        return view('admin.dashboard.contractor_company.index',compact('contractors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        $specialties = Specialty::all();
        $countries = Country::all();
        // $cities = City::where('country_id',$countries->id)->get();
        return view('admin.dashboard.contractor_company.create',compact('specialties','countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [

            'number_of_hours' => 'required|string',
            'company_size'=>'required|string',
            'email' => 'required|email|unique:contractors,email',
            'phone'=> 'required|string',
            'country_id'=> 'required|string',
            'city_id'=> 'required|string',
            'specialty_id'=> 'required|string',
            'status'=> 'required|string',

        ];

        foreach($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.contractor_name"] = 'nullable';
            $rules["{$localeCode}.contractor_address"] = 'nullable';


        }

        $request->validate($rules);

            $allDataExceptImages = $request->except('image');
            $allDataExceptImages['membership_no'] = rand(10000000,99999999);
            $contractor = Contractor::create($allDataExceptImages);
            if($request->file('image'))
            {
                $uploadedlogo = $contractor->addMediaFromRequest('image')->toMediaCollection('image');
                $contractor->update([
                    'image' => $uploadedlogo->getUrl()
                ]);
            }






        return redirect()->route('ContractorCompany.index');
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
        $contractor = Contractor::find($id);

        $specialties = Specialty::all();
        $countries = Country::all();
        $selectedCountryId = $contractor->country_id;
        $selectedCityId = $contractor->city_id;
        return view('admin.dashboard.contractor_company.edit',compact('specialties','selectedCountryId','selectedCityId','contractor','countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {



        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'number_of_hours' => 'required|string',
            'company_size'=>'required|string',
            'email' => 'required|email',
            'phone'=> 'required|string',
            'country_id'=> 'required|string',
            'city_id'=> 'required|string',
            'specialty_id'=> 'required|string',
            'status'=> 'required|string',
        ];

        foreach($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.contractor_name"] = 'nullable';
            $rules["{$localeCode}.contractor_address"] = 'nullable';


        }

        $request->validate($rules);

        $allCategoriesWithoutImages = $request->except(['image']);
        // $allCategoriesWithoutImages['membership_no'] = rand(10000000,99999999);
        $contractor = Contractor::find($id);
        $contractor->update($allCategoriesWithoutImages);

        if ($request->hasFile('image')) {
            // حذف الوسائط القديمة للشعار
            $oldimage = $contractor->getFirstMedia('image');
            if ($oldimage) {
                $oldimage->delete();
            }

            // رفع الشعار الجديد
            $uploadedimage = $contractor->addMediaFromRequest('image')->toMediaCollection('image');

            // تحديث حقل الشعار في قاعدة البيانات
            $contractor->update([
                'image' => $uploadedimage->getUrl(),
            ]);
        }
        return redirect()->route('ContractorCompany.index');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $contractor = Contractor::find($id);
        $contractor->clearMediaCollection('image');
        $contractor->delete();
       return redirect()->route('ContractorCompany.index');
    }
    public function getCities($country_id)
    {
        $cities = City::where('country_id', $country_id)->get();
        return response()->json($cities);
    }
}