<?php

namespace App\Http\Controllers\Institution;

use Illuminate\Http\Request;
use App\Models\VerificationCode;
use App\Http\Controllers\Controller;

class VerificationCodeController extends Controller
{
    public function index()
    {
        return view('institutions.auth.verification-code');
    }

    public function store(Request $request)
    {
        $verification = VerificationCode::where('code' , $request->code)->first();
        if(!isset($verification))
        {
            return redirect()->back()->withErrors(['code' => 'كود غير صحيح']);
        }else{
            return redirect()->route('institutions.home');

        }
    }


}