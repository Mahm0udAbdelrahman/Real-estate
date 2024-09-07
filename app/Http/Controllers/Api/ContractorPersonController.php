<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResource;
use Illuminate\Http\Request;
use App\Models\ContractorPerson;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ContractorPersonResource;
use App\Http\Resources\ContractorPersonShowResource;

class ContractorPersonController extends Controller
{
    public function index()
    {
        $ContractorPerson = ContractorPerson::paginate(4);

        $customDate = response()->json(
            ContractorPersonResource::collection($ContractorPerson)->response()->getData()
        );

        return ApiResource::getResponse(201, 'all data', $customDate);
    }


    public function show($id)
    {
        
         
            $Contractors = ContractorPerson::find($id);
            if(!$Contractors)
            {
                return ApiResource::getResponse(404, 'No Person found with the given ID' );
            }

            return ApiResource::getResponse(201, 'Show Contractor Person', ContractorPersonShowResource::make($Contractors));
       
    }

    public function update(Request $request, $id)
    {

        try {
            $validation = Validator::make(
                $request->all(),
                [
                    'year_of_experience' => 'required|string',
                    'email' => 'required|email',
                    'phone' => 'required|string',
                    'country_id' => 'required|string',
                    'city_id' => 'required|string',
                    'company_id' => 'nullable',
                    'specialty_id' => 'required|string',
                    'status' => 'required|string',
                    'contractor_person_name' => 'required|string',
                    'contractor_person_address' => 'required|string',
                ],


            );

            if ($validation->fails()) {
                return ApiResource::getResponse(422, 'Enter the data correctly', $validation->errors());
            }

            $allCategoriesWithoutImages = $request->except(['image']);
            // $allCategoriesWithoutImages['membership_no'] = rand(10000000, 99999999);
            $contractorperson = ContractorPerson::find($id);
            if(!$contractorperson)
            {
                return ApiResource::getResponse(404, 'No Person found with the given ID' );
            }
            $contractorperson->update($allCategoriesWithoutImages);

            if ($request->hasFile('image')) {
                // حذف الوسائط القديمة للشعار
                $oldimage = $contractorperson->getFirstMedia('image');
                if ($oldimage) {
                    $oldimage->delete();
                }

                // رفع الشعار الجديد
                $uploadedimage = $contractorperson->addMediaFromRequest('image')->toMediaCollection('image');

                // تحديث حقل الشعار في قاعدة البيانات
                $contractorperson->update([
                    'image' => $uploadedimage->getUrl(),
                ]);
            }

            return ApiResource::getResponse(201, 'Show Contractor Person', ContractorPersonShowResource::make($contractorperson));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ApiResource::getResponse(404, 'No Person found with the given ID', []);
        }
    }
}
