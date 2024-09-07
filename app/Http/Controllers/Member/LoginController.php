<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function loginView()
    {
        return view('members.auth.login');
    }
    public function login(Request $request)
    {
        $credentials = array('email' => $request->email  , 'password'=> $request->password);

        if(!Auth::guard('member')->attempt($credentials))
        {
            Alert::error('Error', 'Oops! Member not active!');
        return redirect()->back();

        }else{
            $member = Member::where('id',Auth::guard('member')->user()->id)->first();
            if($member->status == "1")
            {
                return redirect()->route('member.home');
            }else
            {
                // Alert::error('Error', 'Oops! member not active!');
                return redirect()->back()->with('success', 'Oops! member not active!');
            }

        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('member.login_page');

    }
}
