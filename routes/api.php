<?php

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OTPController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\LougoutController;
use App\Http\Controllers\Api\PartnerController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\ConferenceController;
use App\Http\Controllers\Api\RentMaterialController;
use App\Http\Controllers\Api\ManagerPersonController;
use App\Http\Controllers\Api\ManagerCompanyController;
use App\Http\Controllers\Api\RegisterPersonController;
use App\Http\Controllers\Api\RegisterCompanyController;
use App\Http\Controllers\Api\ConsultingPersonController;
use App\Http\Controllers\Api\ContractorPersonController;
use App\Http\Controllers\Api\ConsultingCompanyController;
use App\Http\Controllers\Api\ContractorCompanyController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::controller(AuthController::class)->group(function () {

    Route::post('RegisterCompany', 'RegisterCompany');
    Route::post('RegisterPerson', 'RegisterPerson');
    Route::post('RegisterServiceCompany', 'RegisterServiceCompany');
    Route::post('RegisterServicePerson', 'RegisterServicePerson');
    Route::post('RegisterManagerCompany', 'RegisterManagerCompany');
    Route::post('RegisterManagerPerson', 'RegisterManagerPerson');
    Route::post('RegisterContractorCompany', 'RegisterContractorCompany');
    Route::post('RegisterContractorPerson', 'RegisterContractorPerson');
    Route::post('RegisterPartner', 'RegisterPartner');
    Route::post('RegisterSupplier', 'RegisterSupplier');
});


Route::controller(OTPController::class)->group(function () {

    Route::post('otpRegisterPerson', 'otpRegisterPerson');
    Route::post('otpRegisterCompany', 'otpRegisterCompany');
    Route::post('otpRegisterServiceCompany', 'otpRegisterServiceCompany');
    Route::post('otpRegisterServicePerson', 'otpRegisterServicePerson');
    Route::post('otpRegisterManagerCompany', 'otpRegisterManagerCompany');
    Route::post('otpRegisterManagerPerson', 'otpRegisterManagerPerson');
    Route::post('otpRegisterContractorCompany', 'otpRegisterContractorCompany');
    Route::post('otpRegisterContractorPerson', 'otpRegisterContractorPerson');
    Route::post('otpRegisterPartner', 'otpRegisterPartner');
    Route::post('otpRegisterSupplier', 'otpRegisterSupplier');
});

Route::middleware('auth:sanctum')->group(function () {




    Route::get('country', [CountryController::class, 'getCountry']);
    Route::get('city/{country_id}', [CityController::class, 'getCity']);
    Route::get('setting', [SettingController::class, 'index']);


    Route::controller(ProjectController::class)->group(function () {

        Route::get('allproject', 'index');
        Route::post('createproject', 'store');
        Route::get('showproject/{id}', 'show');
        Route::post('updateproject/{id}', 'update');
        Route::delete('deleteproject/{id}', 'delete');
    });


    Route::controller(RentMaterialController::class)->group(function () {

        Route::get('allRentMaterial', 'index');
        Route::get('showRentMaterial/{id}', 'show');
        Route::post('createRentMaterial', 'store');
        Route::post('updateRentMaterial/{id}', 'update');
        Route::delete('deleteRentMaterial/{id}', 'delete');
    });



    Route::controller(ConsultingCompanyController::class)->group(function () {

        Route::get('allConsultingCompany', 'index');
        Route::get('showConsultingCompany/{id}', 'show');
        Route::post('updateConsultingCompany/{id}', 'update');
    });


    Route::controller(ConsultingPersonController::class)->group(function () {

        Route::get('allConsultingPerson', 'index');
        Route::get('showConsultingPerson/{id}', 'show');
        Route::post('updateConsultingPerson/{id}', 'update');
    });


    Route::controller(ManagerCompanyController::class)->group(function () {

        Route::get('allManagerCompany', 'index');
        Route::get('showManagerCompany/{id}', 'show');
        Route::post('updateManagerCompany/{id}', 'update');
    });


    Route::controller(ManagerPersonController::class)->group(function () {

        Route::get('allManagerPerson', 'index');
        Route::get('showManagerPerson/{id}', 'show');
        Route::post('updateManagerPerson/{id}', 'update');
    });

    Route::controller(RegisterCompanyController::class)->group(function () {

        Route::get('allCompany', 'index');
        Route::get('showCompany/{id}', 'show');
        Route::post('updateCompany/{id}', 'update');
    });


    Route::controller(RegisterPersonController::class)->group(function () {

        Route::get('allPerson', 'index');
        Route::get('showPerson/{id}', 'show');
        Route::post('updatePerson/{id}', 'update');
    });

    Route::get('allCategories', [CategoryController::class, 'index']);
    Route::get('allPosts', [PostController::class, 'index']);

    Route::controller(EventController::class)->group(function () {

        Route::get('allEvent', 'index');
        Route::get('showEvent/{id}', 'show');
    });

    Route::controller(ConferenceController::class)->group(function () {

        Route::get('allConference', 'index');
        Route::get('showConference/{id}', 'show');
    });


    Route::controller(SupplierController::class)->group(function () {

        Route::get('allSupplier', 'index');
        Route::get('showSupplier/{id}', 'show');
        Route::post('updateSupplier/{id}', 'update');
    });


    Route::controller(PartnerController::class)->group(function () {

        Route::get('allPartner', 'index');
        Route::get('showPartner/{id}', 'show');
        Route::post('updatePartner/{id}', 'update');
    });


    Route::controller(ContractorCompanyController::class)->group(function () {

        Route::get('allContractorCompany', 'index');
        Route::get('showContractorCompany/{id}', 'show');
        Route::post('updateContractorCompany/{id}', 'update');
    });

    Route::controller(ContractorPersonController::class)->group(function () {

        Route::get('allContractorPerson', 'index');
        Route::get('showContractorPerson/{id}', 'show');
        Route::post('updateContractorPerson/{id}', 'update');
    });
    Route::post('/logout', [LougoutController::class, 'logout']);
});
