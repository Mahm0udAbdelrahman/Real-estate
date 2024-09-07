<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Country;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\ContractorPerson;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::latest()->get();
        return view('admin.dashboard.suppliers.index',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        $countries = Country::all();

        return view('admin.dashboard.suppliers.create',compact('countries'));
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
            'email' => 'required|email|unique:suppliers,email',
            'phone'=> 'required|string',
            'location' => 'required|string',
            'supplied_material' => 'required|string',
            'country_id'=> 'required|string',
            'city_id'=> 'required|string',
            'status'=> 'required|string',

        ];

        foreach($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'nullable';

        }

        $request->validate($rules);

            $allDataExceptImages = $request->except('image');
            $allDataExceptImages['membership_no'] = rand(10000000,99999999);
            $supplier = Supplier::create($allDataExceptImages);
            if($request->file('image'))
            {
                $uploadedlogo = $supplier->addMediaFromRequest('image')->toMediaCollection('image');
                $supplier->update([
                    'image' => $uploadedlogo->getUrl()
                ]);
            }

        return redirect()->route('suppliers.index');
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
        $supplier = Supplier::find($id);
        $countries = Country::all();
        $selectedCountryId = $supplier->country_id;
        $selectedCityId = $supplier->city_id;
        return view('admin.dashboard.suppliers.edit',compact('supplier','countries','selectedCountryId','selectedCityId'));
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
            'supplied_material' => 'required|string',
            'country_id'=> 'required|string',
            'city_id'=> 'required|string',
            'status'=> 'required|string',
        ];

        foreach($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'nullable';


        }

        $request->validate($rules);

        $allCategoriesWithoutImages = $request->except(['image']);
         

        $supplier = Supplier::find($id);
        $supplier->update($allCategoriesWithoutImages);

        if ($request->hasFile('image')) {
            // حذف الوسائط القديمة للشعار
            $oldimage = $supplier->getFirstMedia('image');
            if ($oldimage) {
                $oldimage->delete();
            }

            // رفع الشعار الجديد
            $uploadedimage = $supplier->addMediaFromRequest('image')->toMediaCollection('image');

            // تحديث حقل الشعار في قاعدة البيانات
            $supplier->update([
                'image' => $uploadedimage->getUrl(),
            ]);
        }

        return redirect()->route('suppliers.index');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $contractorperson = Supplier::find($id);
        $contractorperson->clearMediaCollection('image');
        $contractorperson->delete();
       return redirect()->route('suppliers.index');
    }

    public function getCities($country_id)
    {
        $cities = City::where('country_id', $country_id)->get();
        return response()->json($cities);
    }
}