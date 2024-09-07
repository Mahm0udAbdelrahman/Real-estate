<?php

namespace App\Http\Controllers\Api;

use App\Models\Setting;
use App\Helpers\ApiResource;
use App\Models\RentMaterial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\RentMaterialResource;
use App\Http\Resources\RentMaterialShowResource;

class RentMaterialController extends Controller
{
    public function index()
    {
        $data = RentMaterial::paginate(1);
        if (count($data) > 0) {
            if ($data->total() > $data->perPage()) {
                $customDate = [
                    'data' => RentMaterialResource::collection($data),
                    'pagination_data' => [
                        'currentPage' => $data->currentPage(),
                        'perPage' => $data->perPage(),
                        'total' => $data->total(),
                        'links' => [
                            'first' => $data->url(1),
                            'last' => $data->lastPage(),
                        ],
                    ],

                ];
            } else {
                $customDate = RentMaterialResource::collection($data);
            }

            return ApiResource::getResponse(201, 'all data', $customDate);
        } else {
            return ApiResource::getResponse(401, 'no data', []);
        }
    }

    public function show($id)
    {
        try {
            $RentMaterial = RentMaterial::findOrFail($id);
            return ApiResource::getResponse(200, 'Show RentMaterial', RentMaterialShowResource::make($RentMaterial));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ApiResource::getResponse(404, 'No RentMaterial found with the given ID', []);
        }
    }


    public function store(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'name' => 'required|string',
                'bio' => 'required|string',
                'price' => 'required|string',
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ],


        );

        if ($validation->fails()) {
            return ApiResource::getResponse(422, 'Enter the data correctly', $validation->errors());
        }



        $allDataExceptImages = $request->except(['logo', 'image']);
        $RentMaterial = RentMaterial::create($allDataExceptImages);

        // تحميل وتحديث الشعار إذا تم إرسال ملف الشعار
        if ($request->hasFile('logo')) {
            $uploadedLogo = $RentMaterial->addMediaFromRequest('logo')->toMediaCollection('logo');
            $RentMaterial->update(['logo' => $uploadedLogo->getUrl()]);
        }





        if ($request->hasFile('image')) {
            $imageUrls = [];
            foreach ($request->file('image') as $image) {
                $uploadedImage = $RentMaterial->addMedia($image)->toMediaCollection('image'); // Store each image in the 'images' media collection
                $imageUrls[] = $uploadedImage->getUrl();
            }

            // Update the RentMaterial with the JSON-encoded image URLs
            $RentMaterial->update(['image' => json_encode($imageUrls)]); // Ensure your database has a column for 'images'
        }
        return ApiResource::getResponse(200, 'Create RentMaterial', new RentMaterialShowResource($RentMaterial));
    }

    public function update(Request $request, $id)
    {
        try {
            $validation = Validator::make(
                $request->all(),
                [
                    'name' => 'nullable|string',
                    'bio' => 'nullable|string',
                    'price' => 'nullable|string',
                    'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                    'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                ],
            );

            if ($validation->fails()) {
                return ApiResource::getResponse(422, 'Enter the data correctly', $validation->errors());
            }
            $RentMaterial = RentMaterial::findOrFail($id);

            $allDataExceptImages = $request->except(['logo', 'image']);
            $RentMaterial->update($allDataExceptImages);



            if ($request->hasFile('logo')) {
                // حذف الوسائط القديمة للشعار
                $oldLogo = $RentMaterial->getFirstMedia('logo');
                if ($oldLogo) {
                    $oldLogo->delete();
                }

                // رفع الشعار الجديد
                $uploadedLogo = $RentMaterial->addMediaFromRequest('logo')->toMediaCollection('logo');

                // تحديث حقل الشعار في قاعدة البيانات
                $RentMaterial->update([
                    'logo' => $uploadedLogo->getUrl(),
                ]);
            }



            if ($request->hasFile('image')) {
                // حذف الوسائط القديمة
                $RentMaterial->clearMediaCollection('image');

                $imageUrls = [];
                foreach ($request->file('image') as $image) {
                    $uploadedImage = $RentMaterial->addMedia($image)->toMediaCollection('image');
                    $imageUrls[] = $uploadedImage->getUrl();
                }

                // تحديث حقل الصورة في قاعدة البيانات
                $RentMaterial->update([
                    'images' => json_encode($imageUrls),
                ]);
            }


            return ApiResource::getResponse(200, 'Update RentMaterial', $RentMaterial);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ApiResource::getResponse(404, 'No RentMaterial found with the given ID', []);
        }
    }


    public function delete($id)
    {
        try {
            $RentMaterial = RentMaterial::findOrFail($id);
            $RentMaterial->delete();

            return ApiResource::getResponse(201, 'Delete RentMaterial',[]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ApiResource::getResponse(404, 'No RentMaterial found with the given ID', []);
        }
    }
}
