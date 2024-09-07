<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResource;
use Illuminate\Http\Request;
use App\Models\RegisterPerson;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\RegisterPersonResource;

class RegisterPersonController extends Controller
{
    public function index()
    {
        $person = RegisterPerson::all();

        return ApiResource::getResponse(201, 'all data', RegisterPersonResource::collection($person));
    }
    public function show($id)
    {
        // $RegisterPerson = RegisterPerson::findOrFail($id); // ابحث عن المشروع بناءً على الـ ID
        // if ($RegisterPerson) {
        //     return ApiResource::getResponse(200, 'Details RegisterPerson', new RegisterPersonResource($RegisterPerson)); // استجابة مع تفاصيل المشروع

        // } else {
        //     return ApiResource::getResponse(404, 'ID not found', []); // رسالة عندما يكون الـ ID غير موجود

        // }


        try {
            $RegisterPerson = RegisterPerson::findOrFail($id); // ابحث عن المشروع بناءً على الـ ID
            return ApiResource::getResponse(200, 'Details RegisterPerson', new RegisterPersonResource($RegisterPerson)); // استجابة مع تفاصيل المشروع
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ApiResource::getResponse(404, 'ID not found', []); // رسالة عندما يكون الـ ID غير موجود
        }
    }


    public function update(Request $request, $id)
    {



        $validation = Validator::make(
            $request->all(),
            [
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'email' => 'required|email',
                'phone' => "required|string",
                'gender' => 'required|string',
                'age' => 'required|string',

            ],
        );

        if ($validation->fails()) {
            return ApiResource::getResponse(422, 'Enter the data correctly', $validation->errors());
        }

        $allCategoriesWithoutImages = $request->except(['image']);
        $register_person = RegisterPerson::find($id);

        if ($register_person) {
            $register_person->update($allCategoriesWithoutImages);
        } else {
            return ApiResource::getResponse(404, 'ID not found', []);
        }



        if ($request->hasFile('image')) {
            // حذف الوسائط القديمة للصورة
            $oldImage = $register_person->getFirstMedia('image');
            if ($oldImage) {
                $oldImage->delete();
            }

            // رفع الصورة الجديدة
            $uploadedImage = $register_person->addMediaFromRequest('image')->toMediaCollection('image');

            // تحديث حقل الصورة في قاعدة البيانات
            $register_person->update([
                'image' => $uploadedImage->getUrl(),
            ]);
        }


        return ApiResource::getResponse(201, 'Update Person', RegisterPersonResource::make($register_person));
    }
}
