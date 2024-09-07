<?php

namespace App\Http\Controllers\Api;

use App\Models\Contractor;
use App\Helpers\ApiResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ContractorCompanyResource;
use App\Http\Resources\ContractorCompanyShowResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ContractorCompanyController extends Controller
{
    public function index()
    {
        $ContractorCompany = Contractor::paginate(4);

        $customDate = response()->json(
            ContractorCompanyResource::collection($ContractorCompany)->response()->getData()
        );

        return ApiResource::getResponse(201, 'all data', $customDate);
    }


    public function show($id)
    {
        
            $Contractors = Contractor::find($id);
            if(!$Contractors)
            {
                return ApiResource::getResponse(404, 'No Company found with the given ID' );
            }

            return ApiResource::getResponse(201, 'Show Contractor Company', ContractorCompanyShowResource::make($Contractors));
         
    }
    public function update(Request $request, $id)
    {
        try {
            $validation = Validator::make(
                $request->all(),
                [
                    'contractor_name' => 'required|string',
                    'contractor_address' => 'required|string',
                    'number_of_hours' => 'required|string',
                    'company_size' => 'required|string',
                    'email' => 'required|email',
                    'phone' => 'required|string',
                    'country_id' => 'required|string',
                    'city_id' => 'required|string',
                    'specialty_id' => 'required|string',
                ],


            );

            if ($validation->fails()) {
                return ApiResource::getResponse(422, 'Enter the data correctly', $validation->errors());
            }

            $allCategoriesWithoutImages = $request->except(['image']);
            $contractor = Contractor::find($id);
            if(!$contractor)
            {
                return ApiResource::getResponse(404, 'No Company found with the given ID' );
            }
            $contractor->update($allCategoriesWithoutImages);

            if ($request->hasFile('image')) {
                // حذف الوسائط القديمة للشعار
                $oldimage = $contractor->getFirstMedia('image');
                if ($oldimage) {
                    $oldimage->delete();
                }

                // رفع الشعار الجديد
                $uploadedimage = $contractor->addMediaFromRequest('image')->toMediaCollection('image');

                // تحديث حقل الشعار في قاعدة البيانات
                $contractor->update([
                    'image' => $uploadedimage->getUrl(),
                ]);
            }
            return ApiResource::getResponse(201, 'Show Contractor Company', ContractorCompanyShowResource::make($contractor));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ApiResource::getResponse(404, 'No Company found with the given ID', []);
        }
    }
}
