<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use App\Models\Insurance;
use App\Models\Translation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class InsuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $insurances = Insurance::latest()->get();

        return view('admin.dashboard.insurances.index',compact('insurances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.insurances.create');

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
            $rules["{$localeCode}.name"] = 'nullable';

        }

       $validation = $request->validate($rules);

        $data = $request->all();

        Insurance::create($data);

        return redirect()->route('insurances.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Insurance $insurance)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Insurance $insurance)
    {

        return view('admin.dashboard.insurances.edit',compact('insurance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Insurance $insurance)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'status' => 'required|string',
        ];

        foreach($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'nullable';

        }

         $request->validate($rules);
         $data = $request->all();

        $insurance->update($data);
       return redirect()->route('insurances.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Insurance $insurance)
    {
        $insurance->delete();

        return redirect()->route('insurances.index');
    }
}