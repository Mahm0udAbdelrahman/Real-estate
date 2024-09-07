<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\RegisterPerson;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class RegisterPersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $register_persons = RegisterPerson::latest()->get();
        return view('admin.dashboard.register_persons.index', compact('register_persons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.register_persons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [

            'email' => 'required|email|unique:register_persons,email',
            'phone' => "required|string",
            'gender' => 'required|string',
            'age' => 'required|string',
            'status' => 'required|string',
        ];

        foreach ($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.first_name"] = 'nullable';
            $rules["{$localeCode}.last_name"] = 'nullable';
        }

        $request->validate($rules);

        $allDataExceptImages = $request->except('image');
        $register_person = RegisterPerson::create($allDataExceptImages);
        if ($request->file('image')) {
            $uploadedlogo = $register_person->addMediaFromRequest('image')->toMediaCollection('image');
            $register_person->update([
                'image' => $uploadedlogo->getUrl()
            ]);
        }
        return redirect()->route('register_persons.index');
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
    public function edit(RegisterPerson $registerPerson)
    {
        return view('admin.dashboard.register_persons.edit', compact('registerPerson'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RegisterPerson $register_person)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [

            'email' => 'required|email',
            'phone' => "required|string",
            'gender' => 'required|string',
            'age' => 'required|string',
            'status' => 'required|string',
        ];

        foreach ($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.first_name"] = 'nullable';
            $rules["{$localeCode}.last_name"] = 'nullable';
        }
        $request->validate($rules);

        $allCategoriesWithoutImages = $request->except(['image']);
        $register_person->update($allCategoriesWithoutImages);



        if ($request->hasFile('image')) {
            // حذف الوسائط القديمة للصورة
            $oldImage = $register_person->getFirstMedia('image');
            if ($oldImage) {
                $oldImage->delete();
            }

            // رفع الصورة الجديدة
            $uploadedImage = $register_person->addMediaFromRequest('image')->toMediaCollection('image');

            // تحديث حقل الصورة في قاعدة البيانات
            $register_person->update([
                'image' => $uploadedImage->getUrl(),
            ]);
        }


        return redirect()->route('register_persons.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $register_person = RegisterPerson::findOrFail($id);
        $register_person->clearMediaCollection('image');
        $register_person->delete();
        return redirect()->route('register_persons.index');
    }
}
