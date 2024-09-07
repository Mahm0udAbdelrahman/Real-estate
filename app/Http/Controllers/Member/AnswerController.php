<?php

namespace App\Http\Controllers\Member;

use App\Models\Answer;
use App\Models\Language;
use App\Models\Translation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ask;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $ask = Ask::where('status','1')->get();
        $session = session()->get('locale');
        $lang = Language::where('abbreviations', $session)->first();
        $asks = Translation::where('language_id', $lang->id)->where('model_type', 'Ask')->where('attribute','title')->get();
        return view('admin.dashboard.answers.create',compact('session','lang','asks'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'answer'=> 'required|string',
            'answer_details'=> 'required|string',
        ]);

        Answer::create([
            'answer' => $request->input('answer'),
            'answer_details' => $request->input('answer_details'),
        ]);

        return redirect()->route('admin'); // Replace 'your.route.name' with your actual route name



    }

    /**
     * Display the specified resource.
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Answer $answer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Answer $answer)
    {
        //
    }
}