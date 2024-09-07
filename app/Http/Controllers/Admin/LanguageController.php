<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Languages\StoreRequest;
use App\Http\Requests\Admin\Languages\UpdateRequest;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::latest()->get();
        return view('admin.dashboard.languages.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.languages.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $request->validated();
        $data = $request->except(['flag']);

        $language = Language::create($data);

        if ($request->file('flag')) {
            $uploadedflag = $language->addMediaFromRequest('flag')->toMediaCollection('flag');
            $language->update(['flag' => $uploadedflag->getUrl()]);
        }
        return redirect()->route('languages.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $language = Language::find($id);

        return view('admin.dashboard.languages.show', compact('language'));


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $language = Language::find($id);

        return view('admin.dashboard.languages.edit', compact('language'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Language $language)
    {

        $request->validated();
        $data = $request->except(['flag']);

        $language->update($data);

        if ($request->file('flag')) {
            $oldData = $language->media;
            $oldData[0]->delete();
            $uploadedflag = $language->addMediaFromRequest('flag')

                ->toMediaCollection('flag');
            $language->update([
                'flag' => $uploadedflag->getUrl()
            ]);
        }
        return redirect()->route('languages.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Language $language)
    {
        $language->clearMediaCollection('flag');
        $language->delete();
        return redirect()->route('languages.index');
    }
}