<?php

namespace App\Http\Controllers\Api;

use App\Models\Supplier;
use App\Helpers\ApiResource;
use App\Models\OtherProject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SupplierResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\SupplierShowResource;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::paginate(4);

        $customDate = response()->json(
            SupplierResource::collection($suppliers)->response()->getData()
        );

        return ApiResource::getResponse(201, 'all data', $customDate);
    }


    public function show($id)
    {
     
            $Suppliers = Supplier::find($id);
            if(!$Suppliers)
            {
                return ApiResource::getResponse(404, 'ID not found');
            }
            return ApiResource::getResponse(201, 'Supplier', new SupplierShowResource($Suppliers));
         
    }

    public function update(Request $request, $id)
    {
            $validation = Validator::make(
                $request->all(),
                [
                    'name' => 'required|string',
                    'year_of_experience' => 'required|string',
                    'email' => 'required|email',
                    'phone' => 'required|string',
                    'location' => 'required|string',
                    'supplied_material' => 'required|string',
                    'country_id' => 'required|string',
                    'city_id' => 'required|string',
    
                ],
    
    
            );
    
            if ($validation->fails()) {
                return ApiResource::getResponse(422, 'Enter the data correctly', $validation->errors());
            }
    
    
    
            $allCategoriesWithoutImages = $request->except(['image']);
            
    
    
            $supplier = Supplier::find($id);
            if(!$supplier)
            {
                return ApiResource::getResponse(404, 'ID not found');
            }
            $supplier->update($allCategoriesWithoutImages);
    
            if ($request->hasFile('image')) {
                // حذف الوسائط القديمة للشعار
                $oldimage = $supplier->getFirstMedia('image');
                if ($oldimage) {
                    $oldimage->delete();
                }
    
                // رفع الشعار الجديد
                $uploadedimage = $supplier->addMediaFromRequest('image')->toMediaCollection('image');
    
                // تحديث حقل الشعار في قاعدة البيانات
                $supplier->update([
                    'image' => $uploadedimage->getUrl(),
                ]);
            }
    
            return ApiResource::getResponse(201, 'Update Supplier', SupplierShowResource::make($supplier));
    
      
  }
}
