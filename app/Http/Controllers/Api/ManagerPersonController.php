<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResource;
use Illuminate\Http\Request;
use App\Models\ManagerPerson;
use App\Models\ManagerPersonSub;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ManagerPersonResource;
use App\Http\Resources\ManagerPersonShowResource;

class ManagerPersonController extends Controller
{


    public function index()
    {
        $ManagerPerson = ManagerPerson::all();
        return ApiResource::getResponse(201, 'all data', ManagerPersonResource::collection($ManagerPerson));
    }
    public function show($id)
    {
        try {
            $ManagerPerson = ManagerPerson::findOrFail($id); // ابحث عن المشروع بناءً على الـ ID
            return ApiResource::getResponse(200, 'Details ManagerPerson', new ManagerPersonShowResource($ManagerPerson)); // استجابة مع تفاصيل المشروع
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ApiResource::getResponse(404, 'ID not found', []); // رسالة عندما يكون الـ ID غير موجود
        }
    }
    public function update(Request $request, $id)
    {
        try {
        $validation = Validator::make(
            $request->all(),
            [
                'full_name' => 'required|string',
                'academic_degree' => 'required|string',
                'email' => 'required|string',
                'phone' => 'required|string',
                'age' => 'required|string',
                'year_of_experience' => 'required|string',
                'national_id' => 'file|max:2048',
                'specialty_id' => 'required|string',
                'subspecialty_id' => 'required|array',
                'freelance_license' => 'file|max:2048',
                'cv' => 'file|max:2048',
                'latest_academic_degree' => 'file|max:2048',
                'profile_photo' => 'file|max:2048',

            ],


        );

        if ($validation->fails()) {
            return ApiResource::getResponse(422, 'Enter the data correctly', $validation->errors());
        }
        $allDataExceptFiles = $request->except(['national_id', 'freelance_license', 'cv', 'latest_academic_degree', 'profile_photo']);

        $ManagerPerson = ManagerPerson::findOrFail($id);
        $ManagerPerson->update($allDataExceptFiles);



        if ($request->hasFile('national_id')) {
            // حذف الوسائط القديمة للشعار
            $oldnational_id = $ManagerPerson->getFirstMedia('national_id');
            if ($oldnational_id) {
                $oldnational_id->delete();
            }

            // رفع الشعار الجديد
            $uploadednational_id = $ManagerPerson->addMediaFromRequest('national_id')->toMediaCollection('national_id');

            // تحديث حقل الشعار في قاعدة البيانات
            $ManagerPerson->update([
                'national_id' => $uploadednational_id->getUrl(),
            ]);
        }

        if ($request->hasFile('freelance_license')) {
            // حذف الوسائط القديمة للصورة
            $oldfreelance_license = $ManagerPerson->getFirstMedia('freelance_license');
            if ($oldfreelance_license) {
                $oldfreelance_license->delete();
            }

            // رفع الصورة الجديدة
            $uploadedfreelance_license = $ManagerPerson->addMediaFromRequest('freelance_license')->toMediaCollection('freelance_license');

            // تحديث حقل الصورة في قاعدة البيانات
            $ManagerPerson->update([
                'freelance_license' => $uploadedfreelance_license->getUrl(),
            ]);
        }

        if ($request->hasFile('cv')) {
            // حذف الوسائط القديمة للصورة
            $oldcv = $ManagerPerson->getFirstMedia('cv');
            if ($oldcv) {
                $oldcv->delete();
            }

            // رفع الصورة الجديدة
            $uploadedcv = $ManagerPerson->addMediaFromRequest('cv')->toMediaCollection('cv');

            // تحديث حقل الصورة في قاعدة البيانات
            $ManagerPerson->update([
                'cv' => $uploadedcv->getUrl(),
            ]);
        }

        if ($request->hasFile('latest_academic_degree')) {
            // حذف الوسائط القديمة للصورة
            $oldlatest_academic_degree = $ManagerPerson->getFirstMedia('latest_academic_degree');
            if ($oldlatest_academic_degree) {
                $oldlatest_academic_degree->delete();
            }

            // رفع الصورة الجديدة
            $uploadedlatest_academic_degree = $ManagerPerson->addMediaFromRequest('latest_academic_degree')->toMediaCollection('latest_academic_degree');

            // تحديث حقل الصورة في قاعدة البيانات
            $ManagerPerson->update([
                'latest_academic_degree' => $uploadedlatest_academic_degree->getUrl(),
            ]);
        }

        if ($request->hasFile('profile_photo')) {
            // حذف الوسائط القديمة للصورة
            $oldprofile_photo = $ManagerPerson->getFirstMedia('profile_photo');
            if ($oldprofile_photo) {
                $oldprofile_photo->delete();
            }

            // رفع الصورة الجديدة
            $uploadedprofile_photo = $ManagerPerson->addMediaFromRequest('profile_photo')->toMediaCollection('profile_photo');

            // تحديث حقل الصورة في قاعدة البيانات
            $ManagerPerson->update([
                'profile_photo' => $uploadedprofile_photo->getUrl(),
            ]);
        }

        $subspecialties = $request->subspecialty_id;


        if(isset($subspecialties))
        {
            ManagerPersonSub::where('manager_person_id',$id)->delete();
            for($i=0;$i<sizeof($subspecialties);$i++)
            {
                ManagerPersonSub::create([
                    'manager_person_id' => $id ,
                    'subspecialty_id' => $subspecialties[$i],
                ]);
            }
        }

        return ApiResource::getResponse(201, 'all data', ManagerPersonShowResource::make($ManagerPerson));
        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ApiResource::getResponse(404, 'ID not found', []); // رسالة عندما يكون الـ ID غير موجود
        }
    
    
    }
}