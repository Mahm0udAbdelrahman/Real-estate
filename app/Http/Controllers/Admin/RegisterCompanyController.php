<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\RegisterCompany;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class RegisterCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $register_companies = RegisterCompany::latest()->get();
        return view('admin.dashboard.register_companies.index',compact('register_companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.register_companies.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'email' => "required|email|unique:register_companies,email",
            'phone' => "required|string",
            'number_of_employees'=> 'required|string',
            'location'=> 'required|string',
            'status'=> 'required|string',
       ];

       foreach($locales  as $localeCode => $properties) {
           $rules["{$localeCode}.company_name"] = 'nullable';
           $rules["{$localeCode}.bio"] = 'nullable';


       }

        $request->validate($rules);

            $allDataExceptImages = $request->except('image');
            $register_company = RegisterCompany::create($allDataExceptImages);
            if($request->file('image'))
            {
                $uploadedlogo = $register_company->addMediaFromRequest('image')->toMediaCollection('image');
                $register_company->update([
                    'image' => $uploadedlogo->getUrl()
                ]);
            }
    return redirect()->route('register_companies.index');
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
    public function edit(RegisterCompany $registerCompany)
    {

        return view('admin.dashboard.register_companies.edit',compact('registerCompany'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,RegisterCompany $register_company)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'email'=> 'required|email',
            'phone' => "required|string",
            'number_of_employees'=> 'required|string',
            'location'=> 'required|string',
            'status'=> 'required|string',
       ];

       foreach($locales  as $localeCode => $properties) {
           $rules["{$localeCode}.company_name"] = 'nullable';
           $rules["{$localeCode}.bio"] = 'nullable';


       }
        $request->validate($rules);

        $allCategoriesWithoutImages = $request->except(['image']);
        $register_company->update($allCategoriesWithoutImages);

        if ($request->hasFile('image')) {
            // حذف الوسائط القديمة للصورة
            $oldImage = $register_company->getFirstMedia('image');
            if ($oldImage) {
                $oldImage->delete();
            }

            // رفع الصورة الجديدة
            $uploadedImage = $register_company->addMediaFromRequest('image')->toMediaCollection('image');

            // تحديث حقل الصورة في قاعدة البيانات
            $register_company->update([
                'image' => $uploadedImage->getUrl(),
            ]);
        }


        return redirect()->route('register_companies.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $register_company = RegisterCompany::findOrFail($id);
        $register_company->clearMediaCollection('image');
        $register_company->delete();
        return redirect()->route('register_companies.index');
    }
}