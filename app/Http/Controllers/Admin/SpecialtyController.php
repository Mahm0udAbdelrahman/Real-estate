<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use App\Models\Specialty;
use App\Models\Translation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specialties = Specialty::latest()->get();
        return view('admin.dashboard.specialties.index',compact('specialties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.dashboard.specialties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'status'=> 'required|string',
        ];

        foreach($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'required|string';

        }

       $validation = $request->validate($rules);

        $data = $request->all();

        Specialty::create($data);
        return redirect()->route('specialties.index');
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
    public function edit(Specialty $specialty)
    {


        return view('admin.dashboard.specialties.edit', compact('specialty'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Specialty $specialty)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'status' => 'required|string',
        ];

        foreach($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'required|string';

        }

         $request->validate($rules);
         $data = $request->all();

        $specialty->update($data);

        return redirect()->route('specialties.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialty $specialty)
    {
        $specialty->delete();
        return redirect()->route('specialties.index');
    }
}