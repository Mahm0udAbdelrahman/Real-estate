<?php

namespace App\Http\Controllers\Api;

use App\Models\Partner;
use App\Helpers\ApiResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PartnerResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PartnerShowResource;

class PartnerController extends Controller
{

     public function index()
    {
        $Partners = Partner::paginate(4);

        $customDate = response()->json(
            PartnerResource::collection($Partners)->response()->getData()
        );

        return ApiResource::getResponse(201, 'all data', $customDate);
    }


    public function show($id)
    {
     
            $Partners = Partner::find($id);
            if(empty($Partners)){
                 
                return ApiResource::getResponse(404, 'NOT FOUND ID' ); 
            }

            return ApiResource::getResponse(201, 'Show Partner', PartnerShowResource::make($Partners));
       
        
    }

    public function update(Request $request, $id)
    {

        
            $validation = Validator::make(
                $request->all(),
                [
                    'name' => 'required|string',
                    'year_of_experience' => 'required|string',
                    'email' => 'required|email',
                    'phone'=> 'required|string',
                    'location' => 'required|string',
                    'specialty_id'=> 'required|string',
                    'country_id'=> 'required|string',
                    'city_id'=> 'required|string',
                ],
    
    
            );
    
            if ($validation->fails()) {
                return ApiResource::getResponse(422, 'Enter the data correctly', $validation->errors());
            }
            $allCategoriesWithoutImages = $request->except(['image']);
            $partner = Partner::find($id);
            if(empty($partner)){
                return ApiResource::getResponse(404, 'ID not found'); 
            }
            $partner->update($allCategoriesWithoutImages);
    
            if ($request->hasFile('image')) {
                // حذف الوسائط القديمة للشعار
                $oldimage = $partner->getFirstMedia('image');
                if ($oldimage) {
                    $oldimage->delete();
                }
    
                // رفع الشعار الجديد
                $uploadedimage = $partner->addMediaFromRequest('image')->toMediaCollection('image');
    
                // تحديث حقل الشعار في قاعدة البيانات
                $partner->update([
                    'image' => $uploadedimage->getUrl(),
                ]);
            }
    
            return ApiResource::getResponse(201, 'Update Partner', PartnerShowResource::make($partner));
            

     

    }
}