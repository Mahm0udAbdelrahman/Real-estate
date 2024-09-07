<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subspecialty;
use App\Models\Language;
use App\Models\Specialty;
use App\Models\Translation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SubspecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subspecialties = Subspecialty::latest()->get();


        return view('admin.dashboard.subspecialties.index',compact('subspecialties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $specialties = Specialty::all();
        return view('admin.dashboard.subspecialties.create',compact('specialties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'specialty_id'=> 'required|string',
            'status'=> 'required|string',
        ];

        foreach($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'required|string';

        }

       $validation = $request->validate($rules);

        $data = $request->all();

        Subspecialty::create($data);

    return redirect()->route('subspecialties.index');

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
    public function edit(Subspecialty $subspecialty)
    {
        $specialties = Specialty::all();
        return view('admin.dashboard.subspecialties.edit',compact('specialties','subspecialty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subspecialty $subspecialty)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'specialty_id'=> 'required|string',
            'status'=> 'required|string',
        ];

        foreach($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'required|string';

        }

         $request->validate($rules);
         $data = $request->all();

        $subspecialty->update($data);
       return redirect()->route('subspecialties.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subspecialty = Subspecialty::findOrFail($id);

        $subspecialty->delete();
        return redirect()->route('subspecialties.index');

    }
}