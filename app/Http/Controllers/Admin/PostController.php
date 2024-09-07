<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Category;
use App\Models\Language;
use App\Models\Translation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('admin.dashboard.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::all();
        return view('admin.dashboard.posts.create',compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [

             'category_id'=> 'required|string',
             'status'=> 'required|string',
        ];

        foreach($locales  as $localeCode => $properties) {
            $rules["{$localeCode}.title"] = 'required|string';
            $rules["{$localeCode}.content"] = 'required|string';


        }

        $request->validate($rules);

            $allDataExceptImages = $request->except('image');
            $post = Post::create($allDataExceptImages);
            if($request->file('image'))
            {
                $uploadedlogo = $post->addMediaFromRequest('image')->toMediaCollection('image');
                $post->update([
                    'image' => $uploadedlogo->getUrl()
                ]);
            }
    return redirect()->route('posts.index');

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
    public function edit(Post $post)
    {

        $categories = Category::all();

        return view('admin.dashboard.posts.edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $locales = LaravelLocalization::getSupportedLocales();

        $rules = [

            'category_id'=> 'required|string',
            'status'=> 'required|string',
       ];

       foreach($locales  as $localeCode => $properties) {
           $rules["{$localeCode}.title"] = 'required|string';
           $rules["{$localeCode}.content"] = 'required|string';


       }
        $request->validate($rules);

        $allCategoriesWithoutImages = $request->except(['image']);
        $post->update($allCategoriesWithoutImages);

        if($request->file('image')) {
            $oldData = $post->media;
            $oldData[0]->delete();
            $uploadedimage = $post->addMediaFromRequest('image')
            ->toMediaCollection('image');

            $post->update([
                'image' => $uploadedimage->getUrl()
            ]);

        }


        return redirect()->route('posts.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->clearMediaCollection('image');
        $post->delete();
        return redirect()->route('posts.index');


    }
}