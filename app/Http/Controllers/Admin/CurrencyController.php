<?php

namespace App\Http\Controllers\Admin;

use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currencies = Currency::all();
        return view('admin.dashboard.currencies.index',compact('currencies'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.currencies.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'currency_code'=> 'required|string',
            'exchange_rate'=> 'required|string',
            'currency_symbol'=> 'required|string',
            'status'=> 'required|string',
        ];

        foreach($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.currency_name"] = 'required|string';

        }

       $validation = $request->validate($rules);

        $data = $request->all();

        Currency::create($data);


        return redirect()->route('currencies.index');
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
    public function edit(Currency $currency)
    {
        return view('admin.dashboard.currencies.edit',compact('currency'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Currency $currency)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [
            'currency_code'=> 'required|string',
            'exchange_rate'=> 'required|string',
            'currency_symbol'=> 'required|string',
            'status'=> 'required|string',
        ];

        foreach($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.currency_name"] = 'required|string';


        }

         $request->validate($rules);
         $data = $request->all();

        $currency->update($data);
       return redirect()->route('currencies.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Currency $currency)
    {
        $currency->delete();
        return redirect()->route('currencies.index');

    }
}
