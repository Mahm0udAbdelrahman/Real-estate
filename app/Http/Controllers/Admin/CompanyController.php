<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $companies = Company::latest()->get();


        return view('admin.dashboard.companies.index',compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $countries = Country::all();

        return view('admin.dashboard.companies.create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request ,Company $company)
    {

        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'country_id'=> 'required|string',
             'phone'=> 'required|string',
             'status'=> 'required|string',
        ];

        foreach($locales  as $localeCode => $properties)
        {
            $rules["{$localeCode}.name"] = 'nullable';
            $rules["{$localeCode}.address"] = 'nullable';
            $rules["{$localeCode}.description"] = 'nullable';

        }

        $request->validate($rules);

        $allDataExceptImages = $request->except(['image']);
        $company = Company::create($allDataExceptImages);

        // تحميل وتحديث الشعار إذا تم إرسال ملف الشعار
        if ($request->hasFile('image')) {
            $uploadedimage = $company->addMediaFromRequest('image')->toMediaCollection('image');
            $company->update(['image' => $uploadedimage->getUrl()]);
        }






       return redirect()->route('companies.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {


        $countries = Country::all();

        return view('admin.dashboard.companies.edit',compact('countries' , 'company'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {

        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'country_id'=> 'required|string',
             'phone'=> 'required|string',
             'status'=> 'required|string',
        ];

        foreach($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'nullable';
            $rules["{$localeCode}.address"] = 'nullable';
            $rules["{$localeCode}.description"] = 'nullable';

        }

        $request->validate($rules);
        $allDataExceptImages = $request->except(['image']);
        $company->update($allDataExceptImages);

        if ($request->hasFile('image')) {
            // حذف الوسائط القديمة للشعار
            $oldimage = $company->getFirstMedia('image');
            if ($oldimage) {
                $oldimage->delete();
            }

            // رفع الشعار الجديد
            $uploadedimage = $company->addMediaFromRequest('image')->toMediaCollection('image');

            // تحديث حقل الشعار في قاعدة البيانات
            $company->update([
                'image' => $uploadedimage->getUrl(),
            ]);
        }
        return redirect()->route('companies.index')->with('success', 'Translations updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // $company = Company::find($id);
        $company = Company::where('id', $id)->first();
        // dd($company);
        $company->delete();

       return redirect()->route('companies.index');


    }
    // public function restore(Company $company)
    // {
    //     $company->restore();
    //     return redirect()->route('companies.index');

    // }

    // public function erase(company $company)
    // {
    //     $company->forceDelete();
    //     return redirect()->route('companies.index');

    // }
}