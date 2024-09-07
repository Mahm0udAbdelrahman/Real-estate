<?php

namespace App\Http\Controllers\Api;

use App\Models\OTP;
use App\Helpers\ApiResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class OTPController extends Controller
{
    public function otpRegisterPerson(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $validation = Validator::make(
            $request->all(),
            [
                'code' => 'required',
            ]
        );

        // إذا كان التحقق غير ناجح، ارجع برسالة خطأ
        if ($validation->fails()) {
            return ApiResource::getResponse(422, 'Please enter code', $validation->messages()->all());
        }

        // تحقق من صحة الرمز المرسل
        $otp = OTP::where('code', $request->code)->first();

        if (!$otp) {
            // إذا لم يتم العثور على الرمز، ارجع برسالة خطأ
            return ApiResource::getResponse(401, 'Invalid OTP code', ['code' => $request->code]);
        }

        // الحصول على المستخدم المرتبط بـ OTP
        $user = $otp->RegisterPerson; // افترض أن `user` هو علاقة في موديل OTP

        if (!$user) {
            // إذا لم يتم العثور على المستخدم المرتبط بالرمز، ارجع برسالة خطأ
            return ApiResource::getResponse(401, 'No user associated with this OTP code', ['code' => $request->code]);
        }

        // إذا تم التحقق من صحة الرمز بنجاح، قم بإصدار التوكن
        // $token = $user->createToken($request->token_name)->plainTextToken;
        $token = 'Bearer ' . $user->createToken('access_token')->plainTextToken;

        // أزل OTP بعد التحقق الناجح إذا كنت لا تحتاج إليه لاحقاً
        $otp->delete();

        // ارجع بالبيانات المطلوبة
        return ApiResource::getResponse(200, 'OTP verified successfully', [
            'token' => $token,
        ]);
    }

    public function otpRegisterCompany(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $validation = Validator::make(
            $request->all(),
            [
                'code' => 'required',
            ]
        );

        // إذا كان التحقق غير ناجح، ارجع برسالة خطأ
        if ($validation->fails()) {
            return ApiResource::getResponse(422, 'Please enter code', $validation->messages()->all());
        }

        // تحقق من صحة الرمز المرسل
        $otp = OTP::where('code', $request->code)->first();

        if (!$otp) {
            // إذا لم يتم العثور على الرمز، ارجع برسالة خطأ
            return ApiResource::getResponse(401, 'Invalid OTP code', ['code' => $request->code]);
        }

        // الحصول على المستخدم المرتبط بـ OTP
        $user = $otp->RegisterCompany; // افترض أن `user` هو علاقة في موديل OTP

        if (!$user) {
            // إذا لم يتم العثور على المستخدم المرتبط بالرمز، ارجع برسالة خطأ
            return ApiResource::getResponse(401, 'No user associated with this OTP code', ['code' => $request->code]);
        }

        // إذا تم التحقق من صحة الرمز بنجاح، قم بإصدار التوكن
        // $token = $user->createToken($request->token_name)->plainTextToken;
        $token = 'Bearer ' . $user->createToken('access_token')->plainTextToken;

        // أزل OTP بعد التحقق الناجح إذا كنت لا تحتاج إليه لاحقاً
        $otp->delete();

        // ارجع بالبيانات المطلوبة
        return ApiResource::getResponse(200, 'OTP verified successfully', [
            'token' => $token,
        ]);
    }

    public function otpRegisterServiceCompany(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $validation = Validator::make(
            $request->all(),
            [
                'code' => 'required',
            ]
        );

        // إذا كان التحقق غير ناجح، ارجع برسالة خطأ
        if ($validation->fails()) {
            return ApiResource::getResponse(422, 'Please enter code', $validation->messages()->all());
        }

        // تحقق من صحة الرمز المرسل
        $otp = OTP::where('code', $request->code)->first();

        if (!$otp) {
            // إذا لم يتم العثور على الرمز، ارجع برسالة خطأ
            return ApiResource::getResponse(401, 'Invalid OTP code', ['code' => $request->code]);
        }

        // الحصول على المستخدم المرتبط بـ OTP
        $user = $otp->RegisterServiceCompany; // افترض أن `user` هو علاقة في موديل OTP

        if (!$user) {
            // إذا لم يتم العثور على المستخدم المرتبط بالرمز، ارجع برسالة خطأ
            return ApiResource::getResponse(401, 'No user associated with this OTP code', ['code' => $request->code]);
        }

        // إذا تم التحقق من صحة الرمز بنجاح، قم بإصدار التوكن
        // $token = $user->createToken($request->token_name)->plainTextToken;
        $token = 'Bearer ' . $user->createToken('access_token')->plainTextToken;

        // أزل OTP بعد التحقق الناجح إذا كنت لا تحتاج إليه لاحقاً
        $otp->delete();

        // ارجع بالبيانات المطلوبة
        return ApiResource::getResponse(200, 'OTP verified successfully', [
            'token' => $token,
        ]);
    }

    public function otpRegisterServicePerson(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $validation = Validator::make(
            $request->all(),
            [
                'code' => 'required',
            ]
        );

        // إذا كان التحقق غير ناجح، ارجع برسالة خطأ
        if ($validation->fails()) {
            return ApiResource::getResponse(422, 'Please enter code', $validation->messages()->all());
        }

        // تحقق من صحة الرمز المرسل
        $otp = OTP::where('code', $request->code)->first();

        if (!$otp) {
            // إذا لم يتم العثور على الرمز، ارجع برسالة خطأ
            return ApiResource::getResponse(401, 'Invalid OTP code', ['code' => $request->code]);
        }

        // الحصول على المستخدم المرتبط بـ OTP
        $user = $otp->RegisterServicePerson; // افترض أن `user` هو علاقة في موديل OTP

        if (!$user) {
            // إذا لم يتم العثور على المستخدم المرتبط بالرمز، ارجع برسالة خطأ
            return ApiResource::getResponse(401, 'No user associated with this OTP code', ['code' => $request->code]);
        }

        // إذا تم التحقق من صحة الرمز بنجاح، قم بإصدار التوكن
        // $token = $user->createToken($request->token_name)->plainTextToken;
        $token = 'Bearer ' . $user->createToken('access_token')->plainTextToken;

        // أزل OTP بعد التحقق الناجح إذا كنت لا تحتاج إليه لاحقاً
        $otp->delete();

        // ارجع بالبيانات المطلوبة
        return ApiResource::getResponse(200, 'OTP verified successfully', [
            'token' => $token,
        ]);
    }

    public function otpRegisterManagerCompany(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $validation = Validator::make(
            $request->all(),
            [
                'code' => 'required',
            ]
        );

        // إذا كان التحقق غير ناجح، ارجع برسالة خطأ
        if ($validation->fails()) {
            return ApiResource::getResponse(422, 'Please enter code', $validation->messages()->all());
        }

        // تحقق من صحة الرمز المرسل
        $otp = OTP::where('code', $request->code)->first();

        if (!$otp) {
            // إذا لم يتم العثور على الرمز، ارجع برسالة خطأ
            return ApiResource::getResponse(401, 'Invalid OTP code', ['code' => $request->code]);
        }

        // الحصول على المستخدم المرتبط بـ OTP
        $user = $otp->RegisterManagerCompany; // افترض أن `user` هو علاقة في موديل OTP

        if (!$user) {
            // إذا لم يتم العثور على المستخدم المرتبط بالرمز، ارجع برسالة خطأ
            return ApiResource::getResponse(401, 'No user associated with this OTP code', ['code' => $request->code]);
        }

        // إذا تم التحقق من صحة الرمز بنجاح، قم بإصدار التوكن
        // $token = $user->createToken($request->token_name)->plainTextToken;
        $token = 'Bearer ' . $user->createToken('access_token')->plainTextToken;

        // أزل OTP بعد التحقق الناجح إذا كنت لا تحتاج إليه لاحقاً
        $otp->delete();

        // ارجع بالبيانات المطلوبة
        return ApiResource::getResponse(200, 'OTP verified successfully', [
            'token' => $token,
        ]);
    }

    public function otpRegisterManagerPerson(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $validation = Validator::make(
            $request->all(),
            [
                'code' => 'required',
            ]
        );

        // إذا كان التحقق غير ناجح، ارجع برسالة خطأ
        if ($validation->fails()) {
            return ApiResource::getResponse(422, 'Please enter code', $validation->messages()->all());
        }

        // تحقق من صحة الرمز المرسل
        $otp = OTP::where('code', $request->code)->first();

        if (!$otp) {
            // إذا لم يتم العثور على الرمز، ارجع برسالة خطأ
            return ApiResource::getResponse(401, 'Invalid OTP code', ['code' => $request->code]);
        }

        // الحصول على المستخدم المرتبط بـ OTP
        $user = $otp->RegisterManagerPerson; // افترض أن `user` هو علاقة في موديل OTP

        if (!$user) {
            // إذا لم يتم العثور على المستخدم المرتبط بالرمز، ارجع برسالة خطأ
            return ApiResource::getResponse(401, 'No user associated with this OTP code', ['code' => $request->code]);
        }

        // إذا تم التحقق من صحة الرمز بنجاح، قم بإصدار التوكن
        // $token = $user->createToken($request->token_name)->plainTextToken;
        $token = 'Bearer ' . $user->createToken('access_token')->plainTextToken;

        // أزل OTP بعد التحقق الناجح إذا كنت لا تحتاج إليه لاحقاً
        $otp->delete();

        // ارجع بالبيانات المطلوبة
        return ApiResource::getResponse(200, 'OTP verified successfully', [
            'token' => $token,
        ]);
    }

    public function otpRegisterContractorCompany(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $validation = Validator::make(
            $request->all(),
            [
                'code' => 'required',
            ]
        );

        // إذا كان التحقق غير ناجح، ارجع برسالة خطأ
        if ($validation->fails()) {
            return ApiResource::getResponse(422, 'Please enter code', $validation->messages()->all());
        }

        // تحقق من صحة الرمز المرسل
        $otp = OTP::where('code', $request->code)->first();

        if (!$otp) {
            // إذا لم يتم العثور على الرمز، ارجع برسالة خطأ
            return ApiResource::getResponse(401, 'Invalid OTP code', ['code' => $request->code]);
        }

        // الحصول على المستخدم المرتبط بـ OTP
        $user = $otp->RegisterContractorCompany; // افترض أن `user` هو علاقة في موديل OTP

        if (!$user) {
            // إذا لم يتم العثور على المستخدم المرتبط بالرمز، ارجع برسالة خطأ
            return ApiResource::getResponse(401, 'No user associated with this OTP code', ['code' => $request->code]);
        }

        // إذا تم التحقق من صحة الرمز بنجاح، قم بإصدار التوكن
        // $token = $user->createToken($request->token_name)->plainTextToken;
        $token = 'Bearer ' . $user->createToken('access_token')->plainTextToken;

        // أزل OTP بعد التحقق الناجح إذا كنت لا تحتاج إليه لاحقاً
        $otp->delete();

        // ارجع بالبيانات المطلوبة
        return ApiResource::getResponse(200, 'OTP verified successfully', [
            'token' => $token,
        ]);
    }

    public function otpRegisterContractorPerson(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $validation = Validator::make(
            $request->all(),
            [
                'code' => 'required',
            ]
        );

        // إذا كان التحقق غير ناجح، ارجع برسالة خطأ
        if ($validation->fails()) {
            return ApiResource::getResponse(422, 'Please enter code', $validation->messages()->all());
        }

        // تحقق من صحة الرمز المرسل
        $otp = OTP::where('code', $request->code)->first();

        if (!$otp) {
            // إذا لم يتم العثور على الرمز، ارجع برسالة خطأ
            return ApiResource::getResponse(401, 'Invalid OTP code', ['code' => $request->code]);
        }

        // الحصول على المستخدم المرتبط بـ OTP
        $user = $otp->RegisterContractorPerson; // افترض أن `user` هو علاقة في موديل OTP

        if (!$user) {
            // إذا لم يتم العثور على المستخدم المرتبط بالرمز، ارجع برسالة خطأ
            return ApiResource::getResponse(401, 'No user associated with this OTP code', ['code' => $request->code]);
        }

        // إذا تم التحقق من صحة الرمز بنجاح، قم بإصدار التوكن
        // $token = $user->createToken($request->token_name)->plainTextToken;
        $token = 'Bearer ' . $user->createToken('access_token')->plainTextToken;

        // أزل OTP بعد التحقق الناجح إذا كنت لا تحتاج إليه لاحقاً
        $otp->delete();

        // ارجع بالبيانات المطلوبة
        return ApiResource::getResponse(200, 'OTP verified successfully', [
            'token' => $token,
        ]);
    }

    public function otpRegisterSupplier(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $validation = Validator::make(
            $request->all(),
            [
                'code' => 'required',
            ]
        );

        // إذا كان التحقق غير ناجح، ارجع برسالة خطأ
        if ($validation->fails()) {
            return ApiResource::getResponse(422, 'Please enter code', $validation->messages()->all());
        }

        // تحقق من صحة الرمز المرسل
        $otp = OTP::where('code', $request->code)->first();

        if (!$otp) {
            // إذا لم يتم العثور على الرمز، ارجع برسالة خطأ
            return ApiResource::getResponse(401, 'Invalid OTP code', ['code' => $request->code]);
        }

        // الحصول على المستخدم المرتبط بـ OTP
        $user = $otp->RegisterSupplier; // افترض أن `user` هو علاقة في موديل OTP

        if (!$user) {
            // إذا لم يتم العثور على المستخدم المرتبط بالرمز، ارجع برسالة خطأ
            return ApiResource::getResponse(401, 'No user associated with this OTP code', ['code' => $request->code]);
        }

        // إذا تم التحقق من صحة الرمز بنجاح، قم بإصدار التوكن
        // $token = $user->createToken($request->token_name)->plainTextToken;
        $token = 'Bearer ' . $user->createToken('access_token')->plainTextToken;

        // أزل OTP بعد التحقق الناجح إذا كنت لا تحتاج إليه لاحقاً
        $otp->delete();

        // ارجع بالبيانات المطلوبة
        return ApiResource::getResponse(200, 'OTP verified successfully', [
            'token' => $token,
        ]);
    }

    public function otpRegisterPartner(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $validation = Validator::make(
            $request->all(),
            [
                'code' => 'required',
            ]
        );

        // إذا كان التحقق غير ناجح، ارجع برسالة خطأ
        if ($validation->fails()) {
            return ApiResource::getResponse(422, 'Please enter code', $validation->messages()->all());
        }

        // تحقق من صحة الرمز المرسل
        $otp = OTP::where('code', $request->code)->first();

        if (!$otp) {
            // إذا لم يتم العثور على الرمز، ارجع برسالة خطأ
            return ApiResource::getResponse(401, 'Invalid OTP code', ['code' => $request->code]);
        }

        // الحصول على المستخدم المرتبط بـ OTP
        $user = $otp->RegisterPartner; // افترض أن `user` هو علاقة في موديل OTP

        if (!$user) {
            // إذا لم يتم العثور على المستخدم المرتبط بالرمز، ارجع برسالة خطأ
            return ApiResource::getResponse(401, 'No user associated with this OTP code', ['code' => $request->code]);
        }

        // إذا تم التحقق من صحة الرمز بنجاح، قم بإصدار التوكن
        // $token = $user->createToken($request->token_name)->plainTextToken;
        $token = 'Bearer ' . $user->createToken('access_token')->plainTextToken;

        // أزل OTP بعد التحقق الناجح إذا كنت لا تحتاج إليه لاحقاً
        $otp->delete();

        // ارجع بالبيانات المطلوبة
        return ApiResource::getResponse(200, 'OTP verified successfully', [
            'token' => $token,
        ]);
    }

}
