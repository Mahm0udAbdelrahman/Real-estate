<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\VerificationDoctor;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function loginView()
    {
        
        return view('doctors.auth.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'number' => 'required',
        ]);

        $doctor = Doctor::create(['number' => $request->number])->first();
        if (isset($doctor)) {


            $code = rand(1000, 9999);
            VerificationDoctor::create([
                'doctor_id' => $doctor->id,
                'code' => $code
            ]);
            return redirect()->route("doctor.verificationcode_page");

        } else {
            return redirect()->back()->withErrors(['number' => 'يوجد مشكله']);

        }
    }

    public function logout(Doctor $doctor)
    {
        $doctor->delete();
        return redirect()->route('doctor.login_page');

    }
}