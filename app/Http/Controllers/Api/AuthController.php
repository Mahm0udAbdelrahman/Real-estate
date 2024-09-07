<?php

namespace App\Http\Controllers\Api;

use App\Models\OTP;
use App\Models\Country;
use App\Models\Partner;
use App\Models\Supplier;
use App\Models\Contractor;
use App\Helpers\ApiResource;
use Illuminate\Http\Request;
use App\Models\ManagerPerson;
use App\Models\ServicePerson;
use App\Models\ManagerCompany;
use App\Models\RegisterPerson;
use App\Models\ServiceCompany;
use App\Models\RegisterCompany;
use Illuminate\Validation\Rule;
use App\Models\ContractorPerson;
use App\Http\Resources\OTPResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function RegisterPerson(Request $request)
    {


        $validation = Validator::make(
            $request->all(),
            [
                'country_id' => [
                    'required',
                    'integer', // Ensure country_id is an integer
                    'exists:countries,id', // Check if the country_id exists in the countries table
                ],'country_code' => [
                    'required',
                    'string',
                ],
                'sms_type' => [
                    'required',
                ],

                'phone' =>
                [
                    'required',
                    'string',
                    'regex:/^(01\d{9}|05\d{8})$/', // Allows Egyptian or Saudi phone numbers

                ], // Added regex for phone

               
            ],
            [
                'phone.required' => 'Plz Enter phone',
                'phone.regex' => 'The phone number must be an Egyptian number starting with 01 and 11 digits long or a Saudi number starting with 05 and 10 digits long.',
            ],
            [
                'phone' => 'Your phone'
            ]

        );

        if ($validation->fails()) {
            return ApiResource::getResponse(422, 'Enter the data correctly', $validation->errors());
        }

        $country = Country::where('id', $request->country_id)
        ->where('code', $request->country_code)->first();
        
        if (!$country) {
            return ApiResource::getResponse(404, 'Country not found', []);
        }
        $RegisterPerson = RegisterPerson::where('phone', $request->phone)->first();

        // $otp = OTP::find($id);
        if (isset($RegisterPerson)) {
            $OTPOld = OTP::create([
                'mobile' => $RegisterPerson->phone,
                'register_person_id' => $RegisterPerson->id,
                'code' => rand(10000, 99999),
                'expire_at' => now()->addMinutes(5),
            ]);
            return ApiResource::getResponse(200, 'Create_before', new OTPResource($OTPOld));
        } else {
            $user = RegisterPerson::create([
                'phone' => $request->phone,
                'country_id' => $request->country_id,
            ]);
            $OTPNew = OTP::create([
                'mobile' => $request->phone,
                'register_person_id' => $user->id,
                'code' => rand(10000, 99999),
                'expire_at' => now()->addMinutes(5),
            ]);
            return ApiResource::getResponse(201, 'Created_new', new OTPResource($OTPNew));
        }
          

        // if ($request->sms_type == "sms") {
        // } else {
        // }
    }



    public function RegisterCompany(Request $request)
    {


        $validation = Validator::make(
            $request->all(),
            [

                'phone' => [
                    'required',
                    'string',
                    'regex:/^(01\d{9}|05\d{8})$/', // Allows Egyptian or Saudi phone numbers
                ], // Added regex for phone
                  'country_id' => [
                    'required',
                    'integer', // Ensure country_id is an integer
                    'exists:countries,id', // Check if the country_id exists in the countries table
                ],'country_code' => [
                    'required',
                    'string',
                ],
                'sms_type' => [
                    'required',
                ],
                'country_id' => [
                    'required',
                    'integer', // Ensure country_id is an integer
                    'exists:countries,id', // Check if the country_id exists in the countries table
                ],'country_code' => [
                    'required',
                    'string',
                ],
                'sms_type' => [
                    'required',
                ],

            ],
            [
                'phone.required' => 'Plz Enter phone',
                'phone.regex' => 'The phone number must be an Egyptian number starting with 01 and 11 digits long or a Saudi number starting with 05 and 10 digits long.',
            ],
            [
                'phone' => 'Your phone'
            ]

        );

        if ($validation->fails()) {
            return ApiResource::getResponse(422, 'Enter the data correctly', $validation->errors());
        }
        $country = Country::where('id', $request->country_id)
        ->where('code', $request->country_code)->first();
        
        if (!$country) {
            return ApiResource::getResponse(404, 'Country not found', []);
        }
        $RegisterCompany = RegisterCompany::where('phone', $request->phone)->first();

        // $otp = OTP::find($id);
        if (isset($RegisterCompany)) {
            $OTPOld = OTP::create([
                'mobile' => $RegisterCompany->phone,
                'register_company_id' => $RegisterCompany->id,
                'code' => rand(10000, 99999),
                'expire_at' => now()->addMinutes(5),
            ]);
            return ApiResource::getResponse(200, 'Create_before', new OTPResource($OTPOld));
        } else {
            $user = RegisterCompany::create([
                'phone' => $request->phone,
                'country_id' => $request->country_id,
            ]);
            $OTPNew = OTP::create([
                'mobile' => $request->phone,
                'register_company_id' => $user->id,
                'code' => rand(10000, 99999),
                'expire_at' => now()->addMinutes(5),
            ]);
            return ApiResource::getResponse(201, 'Created_new', new OTPResource($OTPNew));
        }
         // if ($request->sms_type == "sms") {
        // } else {
        // }
    }



    public function RegisterServiceCompany(Request $request)
    {


        $validation = Validator::make(
            $request->all(),
            [

                'phone' => [
                    'required',
                    'string',
                    'regex:/^(01\d{9}|05\d{8})$/', // Allows Egyptian or Saudi phone numbers
                ], 
                'country_id' => [
                    'required',
                    'integer', // Ensure country_id is an integer
                    'exists:countries,id', // Check if the country_id exists in the countries table
                ],'country_code' => [
                    'required',
                    'string',
                ],
                'sms_type' => [
                    'required',
                ],
              
                // Added regex for phone


            ],
            [
                'phone.required' => 'Plz Enter phone',
                'phone.regex' => 'The phone number must be an Egyptian number starting with 01 and 11 digits long or a Saudi number starting with 05 and 10 digits long.',
                'country_id.required' => 'Please enter a country ID',
                'country_id.exists' => 'The selected country does not exist',
            ],
            [
                'phone' => 'Your phone'
            ]

        );

        if ($validation->fails()) {
            return ApiResource::getResponse(422, 'Enter the data correctly', $validation->errors());
        }
        $country = Country::where('id', $request->country_id)
        ->where('code', $request->country_code)->first();
        
        if (!$country) {
            return ApiResource::getResponse(404, 'Country not found', []);
        }
        $ServiceCompany = ServiceCompany::where('phone', $request->phone)->first();

        // $otp = OTP::find($id);
        if (isset($ServiceCompany)) {
            $OTPOld = OTP::create([
                'mobile' => $ServiceCompany->phone,
                'service_company_id' => $ServiceCompany->id,
                'code' => rand(10000, 99999),
                'expire_at' => now()->addMinutes(5),
            ]);
            return ApiResource::getResponse(200, 'Create_before', new OTPResource($OTPOld));
        } else {
            $user = ServiceCompany::create([
                'phone' => $request->phone,
                 'country_id' => $request->country_id,
            ]);
            $OTPNew = OTP::create([
                'mobile' => $request->phone,
                'service_company_id' => $user->id,
                'code' => rand(10000, 99999),
                'expire_at' => now()->addMinutes(5),
            ]);
            return ApiResource::getResponse(201, 'Created_new', new OTPResource($OTPNew));
        }
         // if ($request->sms_type == "sms") {
        // } else {
        // }
    }



    public function RegisterServicePerson(Request $request)
    {


        $validation = Validator::make(
            $request->all(),
            [

                'phone' => [
                    'required',
                    'string',
                    'regex:/^(01\d{9}|05\d{8})$/', // Allows Egyptian or Saudi phone numbers
                ], // Added regex for phone
                  'country_id' => [
                    'required',
                    'integer', // Ensure country_id is an integer
                    'exists:countries,id', // Check if the country_id exists in the countries table
                ],'country_code' => [
                    'required',
                    'string',
                ],
                'sms_type' => [
                    'required',
                ],


            ],
            [
                'phone.required' => 'Plz Enter phone',
                'phone.regex' => 'The phone number must be an Egyptian number starting with 01 and 11 digits long or a Saudi number starting with 05 and 10 digits long.',
            ],
            [
                'phone' => 'Your phone'
            ]

        );

        if ($validation->fails()) {
            return ApiResource::getResponse(422, 'Enter the data correctly', $validation->errors());
        }
          $country = Country::where('id', $request->country_id)
        ->where('code', $request->country_code)->first();
        
        if (!$country) {
            return ApiResource::getResponse(404, 'Country not found', []);
        }
        $ServicePerson = ServicePerson::where('phone', $request->phone)->first();

        // $otp = OTP::find($id);
        if (isset($ServicePerson)) {
            $OTPOld = OTP::create([
                'mobile' => $ServicePerson->phone,
                'service_person_id' => $ServicePerson->id,
                'code' => rand(10000, 99999),
                'expire_at' => now()->addMinutes(5),
            ]);
            return ApiResource::getResponse(200, 'Create_before', new OTPResource($OTPOld));
        } else {
            $user = ServicePerson::create([
                'phone' => $request->phone,
                 'country_id' => $request->country_id,
            ]);
            $OTPNew = OTP::create([
                'mobile' => $request->phone,
                'service_person_id' => $user->id,
                'code' => rand(10000, 99999),
                'expire_at' => now()->addMinutes(5),
            ]);
            return ApiResource::getResponse(201, 'Created_new', new OTPResource($OTPNew));
        }
         // if ($request->sms_type == "sms") {
        // } else {
        // }
    }


    public function RegisterManagerPerson(Request $request)
    {


        $validation = Validator::make(
            $request->all(),
            [

                'phone' => [
                    'required',
                    'string',
                    'regex:/^(01\d{9}|05\d{8})$/', // Allows Egyptian or Saudi phone numbers
                ], // Added regex for phone
                  'country_id' => [
                    'required',
                    'integer', // Ensure country_id is an integer
                    'exists:countries,id', // Check if the country_id exists in the countries table
                ],'country_code' => [
                    'required',
                    'string',
                ],
                'sms_type' => [
                    'required',
                ],


            ],
            [
                'phone.required' => 'Plz Enter phone',
                'phone.regex' => 'The phone number must be an Egyptian number starting with 01 and 11 digits long or a Saudi number starting with 05 and 10 digits long.',
            ],
            [
                'phone' => 'Your phone'
            ]

        );

        if ($validation->fails()) {
            return ApiResource::getResponse(422, 'Enter the data correctly', $validation->errors());
        }
          $country = Country::where('id', $request->country_id)
        ->where('code', $request->country_code)->first();
        
        if (!$country) {
            return ApiResource::getResponse(404, 'Country not found', []);
        }
        $ManagerPerson = ManagerPerson::where('phone', $request->phone)->first();

        // $otp = OTP::find($id);
        if (isset($ManagerPerson)) {
            $OTPOld = OTP::create([
                'mobile' => $ManagerPerson->phone,
                'manager_person_id' => $ManagerPerson->id,
                'code' => rand(10000, 99999),
                'expire_at' => now()->addMinutes(5),
            ]);
            return ApiResource::getResponse(200, 'Create_before', new OTPResource($OTPOld));
        } else {
            $user = ManagerPerson::create([
                'phone' => $request->phone,
                 'country_id' => $request->country_id,
            ]);
            $OTPNew = OTP::create([
                'mobile' => $request->phone,
                'manager_person_id' => $user->id,
                'code' => rand(10000, 99999),
                'expire_at' => now()->addMinutes(5),
            ]);
            return ApiResource::getResponse(201, 'Created_new', new OTPResource($OTPNew));
        }
         // if ($request->sms_type == "sms") {
        // } else {
        // }
    }


    public function RegisterManagerCompany(Request $request)
    {


        $validation = Validator::make(
            $request->all(),
            [

                'phone' => [
                    'required',
                    'string',
                    'regex:/^(01\d{9}|05\d{8})$/', // Allows Egyptian or Saudi phone numbers
                ], // Added regex for phone
                  'country_id' => [
                    'required',
                    'integer', // Ensure country_id is an integer
                    'exists:countries,id', // Check if the country_id exists in the countries table
                ],'country_code' => [
                    'required',
                    'string',
                ],
                'sms_type' => [
                    'required',
                ],


            ],
            [
                'phone.required' => 'Plz Enter phone',
                'phone.regex' => 'The phone number must be an Egyptian number starting with 01 and 11 digits long or a Saudi number starting with 05 and 10 digits long.',
            ],
            [
                'phone' => 'Your phone'
            ]

        );

        if ($validation->fails()) {
            return ApiResource::getResponse(422, 'Enter the data correctly', $validation->errors());
        }
          $country = Country::where('id', $request->country_id)
        ->where('code', $request->country_code)->first();
        
        if (!$country) {
            return ApiResource::getResponse(404, 'Country not found', []);
        }
        $ManagerCompany = ManagerCompany::where('phone', $request->phone)->first();

        // $otp = OTP::find($id);
        if (isset($ManagerCompany)) {
            $OTPOld = OTP::create([
                'mobile' => $ManagerCompany->phone,
                'manager_company_id' => $ManagerCompany->id,
                'code' => rand(10000, 99999),
                'expire_at' => now()->addMinutes(5),
            ]);
            return ApiResource::getResponse(200, 'Create_before', new OTPResource($OTPOld));
        } else {
            $user = ManagerCompany::create([
                'phone' => $request->phone,
                 'country_id' => $request->country_id,
            ]);
            $OTPNew = OTP::create([
                'mobile' => $request->phone,
                'manager_company_id' => $user->id,
                'code' => rand(10000, 99999),
                'expire_at' => now()->addMinutes(5),
            ]);
            return ApiResource::getResponse(201, 'Created_new', new OTPResource($OTPNew));
        }
         // if ($request->sms_type == "sms") {
        // } else {
        // }
    }



    public function RegisterContractorCompany(Request $request)
    {


        $validation = Validator::make(
            $request->all(),
            [

                'phone' => [
                    'required',
                    'string',
                    'regex:/^(01\d{9}|05\d{8})$/', // Allows Egyptian or Saudi phone numbers
                ], // Added regex for phone
                  'country_id' => [
                    'required',
                    'integer', // Ensure country_id is an integer
                    'exists:countries,id', // Check if the country_id exists in the countries table
                ],'country_code' => [
                    'required',
                    'string',
                ],
                'sms_type' => [
                    'required',
                ],


            ],
            [
                'phone.required' => 'Plz Enter phone',
                'phone.regex' => 'The phone number must be an Egyptian number starting with 01 and 11 digits long or a Saudi number starting with 05 and 10 digits long.',
            ],
            [
                'phone' => 'Your phone'
            ]

        );

        if ($validation->fails()) {
            return ApiResource::getResponse(422, 'Enter the data correctly', $validation->errors());
        }
          $country = Country::where('id', $request->country_id)
        ->where('code', $request->country_code)->first();
        
        if (!$country) {
            return ApiResource::getResponse(404, 'Country not found', []);
        }
        $ContractorCompany = Contractor::where('phone', $request->phone)->first();

        // $otp = OTP::find($id);
        if (isset($ContractorCompany)) {
            $OTPOld = OTP::create([
                'mobile' => $ContractorCompany->phone,
                'contractor_id' => $ContractorCompany->id,
                'code' => rand(10000, 99999),
                'expire_at' => now()->addMinutes(5),
            ]);
            return ApiResource::getResponse(200, 'Create_before', new OTPResource($OTPOld));
        } else {
            $user = Contractor::create([
                'phone' => $request->phone,
                'membership_no'  => rand(10000000,99999999),
                'country_id' => $request->country_id,
            ]);
            $OTPNew = OTP::create([
                'mobile' => $request->phone,
                'contractor_id' => $user->id,
                'code' => rand(10000, 99999),
                'expire_at' => now()->addMinutes(5),
            ]);
            return ApiResource::getResponse(201, 'Created_new', new OTPResource($OTPNew));
        }
         // if ($request->sms_type == "sms") {
        // } else {
        // }
    }


    public function RegisterContractorPerson(Request $request)
    {


        $validation = Validator::make(
            $request->all(),
            [

                'phone' => [
                    'required',
                    'string',
                    'regex:/^(01\d{9}|05\d{8})$/', // Allows Egyptian or Saudi phone numbers
                ], // Added regex for phone
                  'country_id' => [
                    'required',
                    'integer', // Ensure country_id is an integer
                    'exists:countries,id', // Check if the country_id exists in the countries table
                ],'country_code' => [
                    'required',
                    'string',
                ],
                'sms_type' => [
                    'required',
                ],


            ],
            [
                'phone.required' => 'Plz Enter phone',
                'phone.regex' => 'The phone number must be an Egyptian number starting with 01 and 11 digits long or a Saudi number starting with 05 and 10 digits long.',
            ],
            [
                'phone' => 'Your phone'
            ]

        );

        if ($validation->fails()) {
            return ApiResource::getResponse(422, 'Enter the data correctly', $validation->errors());
        }
          $country = Country::where('id', $request->country_id)
        ->where('code', $request->country_code)->first();
        
        if (!$country) {
            return ApiResource::getResponse(404, 'Country not found', []);
        }
        $ContractorPerson = ContractorPerson::where('phone', $request->phone)->first();

        // $otp = OTP::find($id);
        if (isset($ContractorPerson)) {
            $OTPOld = OTP::create([
                'mobile' => $ContractorPerson->phone,
                'contractor_person_id' => $ContractorPerson->id,
                'code' => rand(10000, 99999),
                'expire_at' => now()->addMinutes(5),
            ]);
            return ApiResource::getResponse(200, 'Create_before', new OTPResource($OTPOld));
        } else {
            $user = ContractorPerson::create([
                'phone' => $request->phone,
                 'membership_no'  => rand(10000000, 99999999),
                 'country_id' => $request->country_id,
            ]);
            $OTPNew = OTP::create([
                'mobile' => $request->phone,
                'contractor_person_id' => $user->id,
                'code' => rand(10000, 99999),
                'expire_at' => now()->addMinutes(5),
            ]);
            return ApiResource::getResponse(201, 'Created_new', new OTPResource($OTPNew));
        }
         // if ($request->sms_type == "sms") {
        // } else {
        // }
    }


    public function RegisterPartner(Request $request)
    {


        $validation = Validator::make(
            $request->all(),
            [

                'phone' => [
                    'required',
                    'string',
                    'regex:/^(01\d{9}|05\d{8})$/', // Allows Egyptian or Saudi phone numbers
                ], // Added regex for phone
                  'country_id' => [
                    'required',
                    'integer', // Ensure country_id is an integer
                    'exists:countries,id', // Check if the country_id exists in the countries table
                ],'country_code' => [
                    'required',
                    'string',
                ],
                'sms_type' => [
                    'required',
                ],


            ],
            [
                'phone.required' => 'Plz Enter phone',
                'phone.regex' => 'The phone number must be an Egyptian number starting with 01 and 11 digits long or a Saudi number starting with 05 and 10 digits long.',
            ],
            [
                'phone' => 'Your phone'
            ]

        );

        if ($validation->fails()) {
            return ApiResource::getResponse(422, 'Enter the data correctly', $validation->errors());
        }
          $country = Country::where('id', $request->country_id)
        ->where('code', $request->country_code)->first();
        
        if (!$country) {
            return ApiResource::getResponse(404, 'Country not found', []);
        }
        $Partner = Partner::where('phone', $request->phone)->first();

        // $otp = OTP::find($id);
        if (isset($Partner)) {
            $OTPOld = OTP::create([
                'mobile' => $Partner->phone,
                'partner_id' => $Partner->id,
                'code' => rand(10000, 99999),
                'expire_at' => now()->addMinutes(5),
            ]);
            return ApiResource::getResponse(200, 'Create_before', new OTPResource($OTPOld));
        } else {
            $user = Partner::create([
                'phone' => $request->phone,
                'membership_no' => rand(10000000,99999999),
                 'country_id' => $request->country_id,
            ]);
            $OTPNew = OTP::create([
                'mobile' => $request->phone,
                'partner_id' => $user->id,
                'code' => rand(10000, 99999),
                'expire_at' => now()->addMinutes(5),
            ]);
            return ApiResource::getResponse(201, 'Created_new', new OTPResource($OTPNew));
        }
         // if ($request->sms_type == "sms") {
        // } else {
        // }
    }


    public function RegisterSupplier(Request $request)
    {


        $validation = Validator::make(
            $request->all(),
            [

                'phone' => [
                    'required',
                    'string',
                    'regex:/^(01\d{9}|05\d{8})$/', // Allows Egyptian or Saudi phone numbers
                ], // Added regex for phone
                  'country_id' => [
                    'required',
                    'integer', // Ensure country_id is an integer
                    'exists:countries,id', // Check if the country_id exists in the countries table
                ],'country_code' => [
                    'required',
                    'string',
                ],
                'sms_type' => [
                    'required',
                ],


            ],
            [
                'phone.required' => 'Plz Enter phone',
                'phone.regex' => 'The phone number must be an Egyptian number starting with 01 and 11 digits long or a Saudi number starting with 05 and 10 digits long.',
            ],
            [
                'phone' => 'Your phone'
            ]

        );

        if ($validation->fails()) {
            return ApiResource::getResponse(422, 'Enter the data correctly', $validation->errors());
        }
          $country = Country::where('id', $request->country_id)
        ->where('code', $request->country_code)->first();
        
        if (!$country) {
            return ApiResource::getResponse(404, 'Country not found', []);
        }
        $Supplier = Supplier::where('phone', $request->phone)->first();

        // $otp = OTP::find($id);
        if (isset($Supplier)) {
            $OTPOld = OTP::create([
                'mobile' => $Supplier->phone,
                'supplier_id' => $Supplier->id,
                'code' => rand(10000, 99999),
                'expire_at' => now()->addMinutes(5),
            ]);
            return ApiResource::getResponse(200, 'Create_before', new OTPResource($OTPOld));
        } else {
            $user = Supplier::create([
                'phone' => $request->phone,
                'membership_no' => rand(10000000,99999999),
                'country_id' => $request->country_id,
            ]);
            $OTPNew = OTP::create([
                'mobile' => $request->phone,
                'supplier_id' => $user->id,
                'code' => rand(10000, 99999),
                'expire_at' => now()->addMinutes(5),
            ]);
            return ApiResource::getResponse(201, 'Created_new', new OTPResource($OTPNew));
        }
         // if ($request->sms_type == "sms") {
        // } else {
        // }
    }
}
