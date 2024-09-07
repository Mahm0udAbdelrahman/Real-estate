<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Language;
use App\Models\Translation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $categories = Category::latest()->get();
        return view('admin.dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.categories.create');
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

        $request->validate($rules);

            $allDataExceptImages = $request->except('image');
            $categories = Category::create($allDataExceptImages);
            if($request->file('image'))
            {
                $uploadedlogo = $categories->addMediaFromRequest('image')->toMediaCollection('image');
                $categories->update([
                    'image' => $uploadedlogo->getUrl()
                ]);
            }

        return redirect()->route('categories.index');
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
    public function edit(Category $category)
    {
        $translations = Translation::where('model_type','Category')->where('model_id',$category->id)->get();
        $language = Language::all();

        return view('admin.dashboard.categories.edit',compact('category','translations','language'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Category $category)
    {



        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [

             'status'=> 'required|string',
        ];

        foreach($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.name"] = 'nullable';

        }

        $request->validate($rules);

        $allCategoriesWithoutImages = $request->except(['image']);
        $category->update($allCategoriesWithoutImages);

        if($request->file('image')) {
            $oldData = $category->media;
            $oldData[0]->delete();
            $uploadedimage = $category->addMediaFromRequest('image')
            ->toMediaCollection('image');

            $category->update([
                'image' => $uploadedimage->getUrl()
            ]);

        }



        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        $category->clearMediaCollection('image');
        return redirect()->route('categories.index');



    }
}