<?php

namespace App\Http\Controllers\Admin;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packages = Package::latest()->get();
        return view('admin.dashboard.packages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.packages.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'price' => 'required|string',
            'status' => 'required|string',
        ];

        foreach ($locales as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'required|string';
            $rules["{$localeCode}.time"] = 'required|string';
            $rules["{$localeCode}.description"] = 'required|string';
        }

        $request->validate($rules);

        $allDataExceptImages = $request->except('image');
        $package = Package::create($allDataExceptImages);
        if ($request->file('image')) {
            $uploadedlogo = $package->addMediaFromRequest('image')->toMediaCollection('image');
            $package->update([
                'image' => $uploadedlogo->getUrl()
            ]);
        }




        return redirect()->route('packages.index');
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
        $package = Package::findOrFail($id);
        return view('admin.dashboard.packages.edit', compact('package'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'price' => 'required|string',
            'status' => 'required|string',
        ];

        foreach ($locales as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'required|string';
            $rules["{$localeCode}.time"] = 'required|string';
            $rules["{$localeCode}.description"] = 'required|string';

        }

        $request->validate($rules);

        $allCategoriesWithoutImages = $request->except(['image']);
        $package = Package::findOrFail($id);

        $package->update($allCategoriesWithoutImages);

        if ($request->file('image')) {
            $oldData = $package->media;
            $oldData[0]->delete();
            $uploadedimage = $package->addMediaFromRequest('image')
                ->toMediaCollection('image');

            $package->update([
                'image' => $uploadedimage->getUrl()
            ]);

        }


        return redirect()->route('packages.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        $package->clearMediaCollection('image');
        $package->delete();
        return redirect()->route('packages.index');

    }
}