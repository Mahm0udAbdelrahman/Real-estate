<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ask;
use App\Models\Language;
use App\Models\Translation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asks = Ask::latest()->get();
        $session = session()->get('locale');
        $lang = Language::where('abbreviations', $session)->first();
        return view('admin.dashboard.asks.index', compact('asks', 'session', 'lang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $session = session()->get('locale');
        $lang = Language::where('abbreviations', $session)->first();
        return view('admin.dashboard.asks.create', compact('session', 'lang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required|string',
        ]);


        $ask = Ask::create($request->all());


        $langs = $request->language_id;
        $attributes = $request->attribute;
        $translates = $request->translate;

        for ($i = 0; $i < sizeof($langs); $i++) {
            $trans = Translation::where('model_id', $ask->id)->where('model_type', "Ask")
                ->where('language_id', $langs[$i])->where('attribute', $attributes[$i])
                ->where('translate', $translates[$i])->first();
            if ($trans == null) {
                Translation::create([
                    'model_id' => $ask->id,
                    'model_type' => "Ask",
                    'language_id' => $langs[$i],
                    'attribute' => $attributes[$i],
                    'translate' => $translates[$i]
                ]);

            } else {
                continue;
            }
        }
        return redirect()->route('asks.index');
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
    public function edit(Ask $ask)
    {
        $translations = Translation::where('model_type', 'Ask')->where('model_id', $ask->id)->get();
        $language = Language::all();
        $session = session()->get('locale');
        $lang = Language::where('abbreviations', $session)->first();


        return view('admin.dashboard.asks.edit', compact('ask', 'translations', 'language', 'session', 'lang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ask $ask)
    {
        $request->validate([

            'status' => 'required|string',
        ]);


        // Update post except for flag
        $ask->update($request->all());



        $langs = $request->language_id;
        $attributes = $request->attribute;
        $translates = $request->translate;

        for ($i = 0; $i < sizeof($langs); $i++) {
            $trans = Translation::where('model_id', $ask->id)
                ->where('model_type', "Ask")
                ->where('language_id', $langs[$i])
                ->where('attribute', $attributes[$i])
                ->first();

            if ($trans) {
                // If the translation exists, update it
                $trans->update([
                    'language_id' => $langs[$i],
                    'attribute' => $attributes[$i],
                    'translate' => $translates[$i],
                ]);
            } else {
                Translation::create([
                    'model_id' => $ask->id,
                    'model_type' => "Ask",
                    'language_id' => $langs[$i],
                    'attribute' => $attributes[$i],
                    'translate' => $translates[$i]
                ]);
            }
        }


        return redirect()->route('asks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ask = Ask::findOrFail($id);
        $ask->delete();
        Translation::where('model_id', $ask->id)->where('model_type', "Ask")->delete();

        return redirect()->route('asks.index');

    }
}