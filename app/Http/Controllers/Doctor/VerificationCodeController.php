<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use App\Models\VerificationDoctor;
use App\Http\Controllers\Controller;

class VerificationCodeController extends Controller
{
    public function index()
    {
        return view('doctors.auth.verification-code');
    }

    public function store(Request $request)
    {
        $verification = VerificationDoctor::where('code' , $request->code)->first();
        if(!isset($verification))
        {
            return redirect()->back()->withErrors(['code' => 'كود غير صحيح']);
        }else{
            return redirect()->route('doctors.home');

        }
    }


}