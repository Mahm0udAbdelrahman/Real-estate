<?php

namespace App\Http\Controllers\Member;

use App\Models\Language;
use App\Models\Translation;
use App\Models\AddInsurance;
use Illuminate\Http\Request;
use App\Models\Add_Insurance;
use App\Http\Controllers\Controller;

class AddInsuranceController extends Controller
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
        $session = session()->get('locale');
        $lang = Language::where('abbreviations',$session)->first();
        return view('members.auth.add_insurances',compact('session','lang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'insurance_id'=> 'nullable',
            'birthday'=> 'nullable',
            'insurance_card_number'=> 'nullable',
            'insurance_expiry_date'=> 'nullable',
            'status'=> 'nullable',
        ]);

        $insurance_id=$request->insurance_id;
        $birthday=$request->birthday;
        $insurance_card_number=$request->insurance_card_number;
        $insurance_expiry_date=$request->insurance_expiry_date;
        $status=$request->status;
        if($insurance_id && $birthday && $insurance_card_number && $insurance_expiry_date && $status )
        {
        $allDataExceptimage = $request->except('image');

        $add_insurance = AddInsurance::create($allDataExceptimage);
        $image= $request->file('image');
        if(isset($image))
        {
            $uploadedimage = $add_insurance->addMediaFromRequest('image')->toMediaCollection('image');
            $add_insurance->update([
                'image' => $uploadedimage->getUrl()
            ]);
        }
    }


        $langs=$request->language_id;
        $attributes=$request->attribute;
        $translates=$request->translate;
        if($langs && $attributes && $translates)
        {
            for($i=0;$i<sizeof($langs);$i++)
        {
            $trans=Translation::where('model_id',$add_insurance->id)->where('model_type',"Add_Insurance")
            ->where('language_id',$langs[$i])->where('attribute',$attributes[$i])
            ->where('translate',$translates[$i])->first();
            if($trans==null){
                Translation::create([
                    'model_id'=>$add_insurance->id,
                    'model_type'=>"Add_Insurance",
                    'language_id'=>$langs[$i],
                    'attribute'=>$attributes[$i],
                    'translate'=>$translates[$i]
                ]);

            }else
            {
                continue;
            }

        }

        }

        return redirect()->route('member.login_page');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
