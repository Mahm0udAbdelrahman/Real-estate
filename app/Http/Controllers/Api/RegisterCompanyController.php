<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResource;
use Illuminate\Http\Request;
use App\Models\RegisterCompany;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\RegisterCompanyResource;

class RegisterCompanyController extends Controller
{
    public function index()
    {
        $company = RegisterCompany::all();
        return ApiResource::getResponse(201, 'all data', RegisterCompanyResource::collection($company));
    }

    public function show($id)
    {
        try {
            $RegisterCompany = RegisterCompany::findOrFail($id); // ابحث عن المشروع بناءً على الـ ID
            return ApiResource::getResponse(200, 'Details RegisterCompany', new RegisterCompanyResource($RegisterCompany)); // استجابة مع تفاصيل المشروع
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ApiResource::getResponse(404, 'ID not found', []); // رسالة عندما يكون الـ ID غير موجود
        }
    }


    public function update(Request $request, $id)
    {

        $validation = Validator::make(
            $request->all(),
            [
                'company_name' => 'required|string',
                'bio' => 'required|string',
                'email' => 'required|email',
                'phone' => "required|string",
                'number_of_employees' => 'required|string',
                'location' => 'required|string',
                'image' => 'required|image',

            ],


        );

        if ($validation->fails()) {
            return ApiResource::getResponse(422, 'Enter the data correctly', $validation->errors());
        }

        $allCategoriesWithoutImages = $request->except(['image']);
        $register_company = RegisterCompany::find($id);

        if ($register_company) {
            $register_company->update($allCategoriesWithoutImages);
        } else {
            return ApiResource::getResponse(404, 'ID not found', []);
        }


        if ($request->hasFile('image')) {
            // حذف الوسائط القديمة للصورة
            $oldImage = $register_company->getFirstMedia('image');
            if ($oldImage) {
                $oldImage->delete();
            }

            // رفع الصورة الجديدة
            $uploadedImage = $register_company->addMediaFromRequest('image')->toMediaCollection('image');

            // تحديث حقل الصورة في قاعدة البيانات
            $register_company->update([
                'image' => $uploadedImage->getUrl(),
            ]);
        }


        return ApiResource::getResponse(201, 'Update Company', RegisterCompanyResource::make($register_company));
    }
}
