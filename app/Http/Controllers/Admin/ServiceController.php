<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Models\Subspecialty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::latest()->get();


        return view('admin.dashboard.services.index',compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $subspecialties = Subspecialty::all();
        return view('admin.dashboard.services.create',compact('subspecialties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'subspecialty_id'=> 'required|string',
            'status'=> 'required|string',
        ];

        foreach($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'required|string';

        }

       $validation = $request->validate($rules);

        $data = $request->all();

        Service::create($data);

    return redirect()->route('services.index');

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
    public function edit(Service $service)
    {
        $subspecialties = Subspecialty::all();
        return view('admin.dashboard.services.edit',compact('service','subspecialties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'subspecialty_id'=> 'required|string',
            'status'=> 'required|string',
        ];

        foreach($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'required|string';

        }

         $request->validate($rules);
         $data = $request->all();

        $service->update($data);
       return redirect()->route('services.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);

        $service->delete();
        return redirect()->route('services.index');

    }
}
