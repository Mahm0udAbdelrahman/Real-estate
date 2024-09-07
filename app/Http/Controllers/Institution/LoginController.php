<?php

namespace App\Http\Controllers\Institution;

use Illuminate\Http\Request;
use App\Models\LoginInstitution;
use App\Models\VerificationCode;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function loginView()
    {
        
        return view('institutions.auth.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'number' => 'required',

        ]);

        $institution = LoginInstitution::create(['number' => $request->number])->first();
        if (isset($institution)) {


            $code = rand(1000, 9999);
            VerificationCode::create([
                'login_institution_id' => $institution->id,
                'code' => $code
            ]);
            return redirect()->route("institution.verificationcode_page");

        } else {
            return redirect()->back()->withErrors(['number' => 'يوجد مشكله']);

        }
    }

    public function logout(LoginInstitution $institution)
    {



        Auth::logout();
        $institution->number == null ;
        return redirect()->route('institution.login_page');

    }
}