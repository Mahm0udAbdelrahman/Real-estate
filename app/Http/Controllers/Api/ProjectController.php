<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use App\Helpers\ApiResource;
use App\Models\OtherProject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ProjectShowResource;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProjectController extends Controller
{

    public function index(Request $request)
    {

        $data = OtherProject::paginate(4);

        $customDate = response()->json(
            ProjectResource::collection($data)->response()->getData()
        );

        return ApiResource::getResponse(201, 'all data', $customDate);
    }

    public function store(Request $request)
    {
        // التحقق من صحة البيانات
        $validation = Validator::make(
            $request->all(),
            [
                'title' => 'required|string',
                'content' => 'required|string',
                'date' => 'required|string',
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'user_type' => 'required|string',
            ]
        );

        if ($validation->fails()) {
            return ApiResource::getResponse(422, 'Enter the data correctly', $validation->errors());
        }

        // خريطة تربط user_type بالنموذج المناسب واسم العمود في جدول OtherProject
        $modelMap = [
            'Partner' => ['model' => \App\Models\Partner::class, 'column' => 'partner_id'],
            'Supplier' => ['model' => \App\Models\Supplier::class, 'column' => 'supplier_id'],
            'Contractor' => ['model' => \App\Models\Contractor::class, 'column' => 'contractor_id'],
            'ContractorPerson' => ['model' => \App\Models\ContractorPerson::class, 'column' => 'contractor_person_id'],
            'ManagerCompany' => ['model' => \App\Models\ManagerCompany::class, 'column' => 'manager_company_id'],
            'ManagerPerson' => ['model' => \App\Models\ManagerPerson::class, 'column' => 'manager_person_id'],
            'ServiceCompany' => ['model' => \App\Models\ServiceCompany::class, 'column' => 'service_company_id'],
            'ServicePerson' => ['model' => \App\Models\ServicePerson::class, 'column' => 'service_person_id'],
            'RegisterCompany' => ['model' => \App\Models\RegisterCompany::class, 'column' => 'register_company_id'],
            'RegisterPerson' => ['model' => \App\Models\RegisterPerson::class, 'column' => 'register_person_id'],
            'RentMaterial' => ['model' => \App\Models\RentMaterial::class, 'column' => 'rent_material_id'],
        ];

        // تحقق من أن اسم النموذج موجود في الخريطة
        if (!array_key_exists($request->user_type, $modelMap)) {
            return ApiResource::getResponse(422, 'Invalid model name', ['user_type' => 'The provided model does not exist in the map.']);
        }

        // الحصول على الكلاس الصحيح واسترجاع الـ ID المناسب والعمود المرتبط به
        $modelClass = $modelMap[$request->user_type]['model'];
        $column = $modelMap[$request->user_type]['column'];
        $modelInstance = $modelClass::first(); // قم بتعديل هذه السطر إذا كنت تريد استرجاع ID معين بناءً على شرط

        if (!$modelInstance) {
            return ApiResource::getResponse(404, 'Model instance not found', []);
        }

        // استثناء الصور من البيانات الأخرى
        $allDataExceptImages = $request->except(['logo', 'image']);

        // وضع الـ ID الخاص بالموديل في العمود الصحيح
        $allDataExceptImages[$column] = $modelInstance->id;

        // إنشاء المشروع
        $project = OtherProject::create($allDataExceptImages);

        // تحميل وتحديث الشعار إذا تم إرسال ملف الشعار
        if ($request->hasFile('logo')) {
            $uploadedLogo = $project->addMediaFromRequest('logo')->toMediaCollection('logo');
            $project->update(['logo' => $uploadedLogo->getUrl()]);
        }

        // تحميل وتحديث الصور إذا تم إرسالها
        if ($request->hasFile('image')) {
            $imageUrls = [];
            foreach ($request->file('image') as $image) {
                $uploadedImage = $project->addMedia($image)->toMediaCollection('image');
                $imageUrls[] = $uploadedImage->getUrl();
            }

            $project->update(['image' => json_encode($imageUrls)]);
        }

        return ApiResource::getResponse(200, 'Create project', new ProjectShowResource($project));
    }


    public function show(Request $request, $id)
    {
        // $Project = Project::where('id',$id)->get();       
        // return ApiResource::getResponse(201, 'Details Project', ProjectShowResource::collection($Project));

        try {
            $project = OtherProject::findOrFail($id); // ابحث عن المشروع بناءً على الـ ID
            return ApiResource::getResponse(200, 'Details Project', new ProjectShowResource($project)); // استجابة مع تفاصيل المشروع
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ApiResource::getResponse(404, 'ID not found', []); // رسالة عندما يكون الـ ID غير موجود
        }

        if (!$request->hasHeader('Authorization')) {
            return ApiResource::getResponse(401, 'You are not logged in', []);
        }
    }



    public function update(Request $request, $id)
    {
        try
        {
            $validation = Validator::make(
                $request->all(),
                [
                    'title' => 'required|string',
                    'content' => 'required|string',
                    'date' => 'required|string',
                    'user_type' => 'sometimes|required|string', // تأكد من صحة user_type إذا تم تقديمه
                ]
            );
    
            if ($validation->fails()) {
                return ApiResource::getResponse(422, 'Enter the data correctly', $validation->errors());
            }
    
            // استثناء الصور من البيانات الأخرى
            $allDataExceptImages = $request->except(['logo', 'image']);
    
            // البحث عن المشروع
            $project = OtherProject::findOrFail($id);
          
            
            // إذا تم تقديم user_type، قم بتحديث العمود المناسب
            if ($request->has('user_type')) {
                $modelMap = [
                    'Partner' => ['model' => \App\Models\Partner::class, 'column' => 'partner_id'],
                    'Supplier' => ['model' => \App\Models\Supplier::class, 'column' => 'supplier_id'],
                    'Contractor' => ['model' => \App\Models\Contractor::class, 'column' => 'contractor_id'],
                    'ContractorPerson' => ['model' => \App\Models\ContractorPerson::class, 'column' => 'contractor_person_id'],
                    'ManagerCompany' => ['model' => \App\Models\ManagerCompany::class, 'column' => 'manager_company_id'],
                    'ManagerPerson' => ['model' => \App\Models\ManagerPerson::class, 'column' => 'manager_person_id'],
                    'ServiceCompany' => ['model' => \App\Models\ServiceCompany::class, 'column' => 'service_company_id'],
                    'ServicePerson' => ['model' => \App\Models\ServicePerson::class, 'column' => 'service_person_id'],
                ];
    
                if (!array_key_exists($request->user_type, $modelMap)) {
                    return ApiResource::getResponse(422, 'Invalid model name', ['user_type' => 'The provided model does not exist in the map.']);
                }
    
                $modelClass = $modelMap[$request->user_type]['model'];
                $column = $modelMap[$request->user_type]['column'];
                $modelInstance = $modelClass::first();
    
                if (!$modelInstance) {
                    return ApiResource::getResponse(422, 'Model instance not found', []);
                }
    
                // تحديث الـ ID الخاص بالنموذج في العمود الصحيح
                $allDataExceptImages[$column] = $modelInstance->id;
            }
    
            // تحديث المشروع
            $project->update($allDataExceptImages);
    
            // تحديث الشعار إذا تم تقديم ملف شعار جديد
            if ($request->hasFile('logo')) {
                $oldLogo = $project->getFirstMedia('logo');
                if ($oldLogo) {
                    $oldLogo->delete();
                }
    
                $uploadedLogo = $project->addMediaFromRequest('logo')->toMediaCollection('logo');
                $project->update(['logo' => $uploadedLogo->getUrl()]);
            }
    
            // تحديث الصور إذا تم تقديم صور جديدة
            if ($request->hasFile('image')) {
                $project->clearMediaCollection('image');
    
                $imageUrls = [];
                foreach ($request->file('image') as $image) {
                    $uploadedImage = $project->addMedia($image)->toMediaCollection('image');
                    $imageUrls[] = $uploadedImage->getUrl();
                }
    
                $project->update(['images' => json_encode($imageUrls)]);
            }
    
            return ApiResource::getResponse(200, 'Update project', new ProjectShowResource($project));
      

        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ApiResource::getResponse(404, 'No project found with the given ID', []);
        }
        // التحقق من صحة البيانات
    }


    public function delete(Request $request, $id)
    {


        try {
            $project = OtherProject::findOrFail($id);
            $project->delete();
            return ApiResource::getResponse(200, 'Project deleted successfully', []);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ApiResource::getResponse(404, 'No project found with the given ID', []);
        }
    }
}
