<?php


use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\AskController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\InsuranceController;
use App\Http\Controllers\Admin\SpecialtyController;
use App\Http\Controllers\Admin\ConferenceController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RentMaterialController;
use App\Http\Controllers\Admin\SubspecialtyController;
use App\Http\Controllers\Admin\AdvertisementController;
use App\Http\Controllers\Admin\ManagerPersonController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\ManagerCompanyController;
use App\Http\Controllers\Admin\PartnerProjectController;
use App\Http\Controllers\Admin\RegisterPersonController;
use App\Http\Controllers\Admin\RegisterCompanyController;
use App\Http\Controllers\Admin\SupplierProjectController;
use App\Http\Controllers\Admin\ContractorPersonController;
use App\Http\Controllers\Admin\ContractorCompanyController;
use App\Http\Controllers\Admin\ManagerPersonFileController;
use App\Http\Controllers\Admin\ManagerCompanyFileController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Admin\ConsultingPersonFileController;
use App\Http\Controllers\Admin\ConsultingCompanyFileController;
use App\Http\Controllers\Admin\ConsultingPersonProjectController;
use App\Http\Controllers\Admin\ContractorPersonProjectController;
use App\Http\Controllers\Admin\ConsultingCompanyProjectController;
use App\Http\Controllers\Admin\ContractorCompanyProjectController;
use App\Http\Controllers\Admin\RegisterConsultingServicePersonController;
use App\Http\Controllers\Admin\RegisterConsultingServiceCompanyController;



    Route::group(
        [
            'prefix' => LaravelLocalization::setLocale(),
            'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ],
        ], function(){
            Route::group(['prefix' => 'admin'], function () {
                Route::get('/login', [LoginController::class, "loginView"])->name('admin.login_page');
                Route::post('/login', [LoginController::class, "login"])->name('login');
                Route::get('/logout', [LoginController::class, "logout"])->name('logout');


                Route::middleware(['admin-role'])->group(function () {
                    Route::get('/admincp', function () {
                        return view('admin.home');
                    })->name('admin');

                    Route::resources([
                        'permissions' => PermissionController::class,
                        'roles' => RoleController::class,
                        'admins' => AdminController::class,
                        'countries' => CountryController::class,
                        'cities' => CityController::class,
                        'companies' => CompanyController::class,
                        'settings' => SettingController::class,
                        'languages' => LanguageController::class,
                        'categories' => CategoryController::class,
                        'posts' => PostController::class,
                        'advertisements' => AdvertisementController::class,
                        'insurances' => InsuranceController::class,
                        'asks' => AskController::class,
                        'specialties' => SpecialtyController::class,
                        'subspecialties' => SubspecialtyController::class,
                        'ContractorCompany' => ContractorCompanyController::class,
                        'packages' => PackageController::class,
                        'currencies' => CurrencyController::class,
                        'payment-methods' => PaymentMethodController::class,
                        'register_companies' => RegisterCompanyController::class,
                        'register_persons' => RegisterPersonController::class,
                        'ConsultingServiceCompany' => RegisterConsultingServiceCompanyController::class,
                        'ConsultingServicePerson' => RegisterConsultingServicePersonController::class,
                        'comments' => CommentController::class,
                        'projects' => ProjectController::class,
                        'ManagerCompany' =>  ManagerCompanyController::class,
                        'ManagerPerson' => ManagerPersonController::class,
                        'ContractorPersons' => ContractorPersonController::class,
                        'RentMaterial' => RentMaterialController::class,
                        'events' => EventController::class,
                        'conferences' => ConferenceController::class,
                        'suppliers' => SupplierController::class,
                        'partners' => PartnerController::class,
                        'services' => ServiceController::class,
                        'bookings' => BookingController::class,
                        'partner_projects' => PartnerProjectController::class,
                        'supplier_projects' => SupplierProjectController::class,
                        'contractor_person_projects'  => ContractorPersonProjectController::class,
                        'contractor_company_projects' => ContractorCompanyProjectController::class,
                        'consulting_company_projects' => ConsultingCompanyProjectController::class,
                        'consulting_person_projects' => ConsultingPersonProjectController::class,

                    ]);


                    Route::get('/get-subspecialties/{specialty_id}', [RegisterConsultingServiceCompanyController::class, 'getSubspecialties']);
                    Route::get('/get-services/{subspecialty_id}', [RegisterConsultingServiceCompanyController::class, 'getServices']);

                    Route::get('/get-subspecialties/{specialty_id}', [RegisterConsultingServicePersonController::class, 'getSubspecialties']);
                    Route::get('/get-services/{subspecialty_id}', [RegisterConsultingServicePersonController::class, 'getServices']);

                    Route::get('/get-subspecialties/{specialty_id}', [ManagerCompanyController::class, 'getSubspecialties']);
                    Route::get('/get-services/{subspecialty_id}', [ManagerCompanyController::class, 'getServices']);

                    Route::get('/get-subspecialties/{specialty_id}', [ManagerPersonController::class, 'getSubspecialties']);
                    Route::get('/get-services/{subspecialty_id}', [ManagerPersonController::class, 'getServices']);

                    Route::get('/get-cities/{country_id}', [PartnerController::class, 'getCities']);
                    Route::get('/get-cities/{country_id}', [SupplierController::class, 'getCities']);
                    Route::get('/get-cities/{country_id}', [ContractorPersonController::class, 'getCities']);
                    Route::get('/get-cities/{country_id}', [ContractorCompanyController::class, 'getCities']);
                    Route::resource('members', MemberController::class)->except('create', 'store');
                    Route::get('companies/restore/{institution}', [CompanyController::class, 'restore'])->name('companies.restore');
                    Route::get('companies/erase/{institution}', [CompanyController::class, 'erase'])->name('companies.erase');
                });




        });
    });