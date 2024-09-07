<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use App\Models\Translation;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $advertisements = Advertisement::latest()->get();

        return view('admin.dashboard.advertisements.index',compact('advertisements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.advertisements.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'price'=> 'required|string',
            'from' => 'required|string',
            'to' => 'required|string',
            'status'=> 'required|string',
        ];

        foreach($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.title"] = 'nullable';
            $rules["{$localeCode}.address"] = 'nullable';
            $rules["{$localeCode}.description"] = 'nullable';

        }

            $request->validate($rules);
            $allData = $request->all();
            Advertisement::create($allData);

        return redirect()->route('advertisements.index')->with('success', 'Advertisements Created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Advertisement $advertisement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Advertisement $advertisement)
    {
        return view('admin.dashboard.advertisements.edit',compact('advertisement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Advertisement $advertisement)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'price'=> 'required|string',
            'from' => 'required|string',
            'to' => 'required|string',
            'status'=> 'required|string',
        ];

        foreach($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.title"] = 'nullable';
            $rules["{$localeCode}.address"] = 'nullable';
            $rules["{$localeCode}.description"] = 'nullable';

        }

            $request->validate($rules);
            $allData = $request->all();
            $advertisement->update($allData);


       return redirect()->route('advertisements.index')->with('success', 'Advertisements updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Advertisement $advertisement)
    {
        $advertisement->delete();
       return redirect()->route('advertisements.index');

    }
}