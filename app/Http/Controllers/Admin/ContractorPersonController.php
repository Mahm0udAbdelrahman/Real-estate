<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Specialty;
use App\Models\ContractorPerson;
use App\Models\Country;
use App\Models\City;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ContractorPersonController extends Controller
{
    public function index()
    {
        $ContractorPersons = ContractorPerson::latest()->get();
        return view('admin.dashboard.contractor_persons.index', compact('ContractorPersons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        $companies = Company::all();
        $specialties = Specialty::all();
        $countries = Country::all();
        // $cities = City::all();
        // $cities = City::where('country_id',$countries->id)->get();
        return view('admin.dashboard.contractor_persons.create', compact('companies', 'specialties', 'countries'));
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
                'email' => 'required|email|unique:contractor_persons,email',
                'phone' => 'required|string',
                'country_id' => 'required|string',
                'city_id' => 'required|string',
                'company_id' => 'nullable',
                'specialty_id' => 'required|string',
                'status' => 'required|string',

            ];

        foreach ($locales as $localeCode => $properties) {
            $rules["{$localeCode}.contractor_person_name"] = 'nullable';
            $rules["{$localeCode}.contractor_person_address"] = 'nullable';


        }

        $request->validate($rules);

        $allDataExceptImages = $request->except('image');
        $allDataExceptImages['membership_no'] = rand(10000000, 99999999);
        $contractorPerson = ContractorPerson::create($allDataExceptImages);
        if ($request->file('image')) {
            $uploadedlogo = $contractorPerson->addMediaFromRequest('image')->toMediaCollection('image');
            $contractorPerson->update([
                'image' => $uploadedlogo->getUrl()
            ]);
        }

        return redirect()->route('ContractorPersons.index');
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
        $contractorperson = ContractorPerson::find($id);
        $companies = Company::all();
        $specialties = Specialty::all();
        $countries = Country::all();
        $selectedCountryId = $contractorperson->country_id;
        $selectedCityId = $contractorperson->city_id;
        return view('admin.dashboard.contractor_persons.edit', compact('specialties', 'companies', 'contractorperson', 'countries', 'selectedCountryId', 'selectedCityId'));
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
            'phone' => 'required|string',
            'country_id' => 'required|string',
            'city_id' => 'required|string',
            'company_id' => 'nullable',
            'specialty_id' => 'required|string',
            'status' => 'required|string',
        ];

        foreach ($locales as $localeCode => $properties) {
            $rules["{$localeCode}.contractor_person_name"] = 'nullable';
            $rules["{$localeCode}.contractor_person_address"] = 'nullable';


        }

        $request->validate($rules);

        $allCategoriesWithoutImages = $request->except(['image']);
        // $allCategoriesWithoutImages['membership_no'] = rand(10000000, 99999999);
        $contractorperson = ContractorPerson::find($id);
        $contractorperson->update($allCategoriesWithoutImages);

        if ($request->hasFile('image')) {
            // حذف الوسائط القديمة للشعار
            $oldimage = $contractorperson->getFirstMedia('image');
            if ($oldimage) {
                $oldimage->delete();
            }

            // رفع الشعار الجديد
            $uploadedimage = $contractorperson->addMediaFromRequest('image')->toMediaCollection('image');

            // تحديث حقل الشعار في قاعدة البيانات
            $contractorperson->update([
                'image' => $uploadedimage->getUrl(),
            ]);
        }

        return redirect()->route('ContractorPersons.index');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $contractorperson = ContractorPerson::find($id);
        $contractorperson->clearMediaCollection('image');
        $contractorperson->delete();
        return redirect()->route('ContractorPersons.index');
    }

    public function getCities($country_id)
    {
        $cities = City::where('country_id', $country_id)->get();
        return response()->json($cities);
    }

}