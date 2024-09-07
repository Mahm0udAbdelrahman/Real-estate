<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
 use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function loginView()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $credentials = array('email' => $request->email  , 'password'=> $request->password);

        if(!Auth::guard('admin')->attempt($credentials))
        {
            Alert::error('Error', 'Oops! Admin not active!');
        return redirect()->back();

        }else{
            $admin = Admin::where('id',Auth::guard('admin')->user()->id)->first();
            if($admin->status == "1")
            {
                return redirect()->route('admin');
            }else
            {
                Alert::error('Error', 'Oops! Admin not active!');
                return redirect()->back();
            }

        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login_page');

    }
}