<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Country;
use App\Models\Language;
use App\Models\Translation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $cities = City::latest()->get();
        return view('admin.dashboard.cities.index',compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $countries = Country::all();
        return view('admin.dashboard.cities.create',compact('countries'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'country_id'=> 'required|string',
            'status'=> 'required|string',
        ];

        foreach($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'required|string';

        }

       $validation = $request->validate($rules);

        $data = $request->all();

        City::create($data);








        return redirect()->route('cities.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        $countries = Country::all();
        return view('admin.dashboard.cities.edit', compact('city', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, City $city)
    {


        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'country_id' => 'required|string',
            'status' => 'required|string',
        ];

        foreach($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'required|string';

        }

         $request->validate($rules);
         $data = $request->all();

        $city->update($data);
       return redirect()->route('cities.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        $city->delete();
       return redirect()->route('cities.index');

    }
}
