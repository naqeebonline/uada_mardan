<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserRegistrationController;
use App\Http\Controllers\Admin\PropertyCaseController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\UserVerificationController;
use App\Http\Controllers\Admin\PlazaController;
use App\Http\Controllers\Admin\PlazaFloorController;
use App\Http\Controllers\Admin\PlazaShopsController;
use App\Http\Controllers\Admin\AuctionController;
use App\Http\Controllers\Admin\RentCollectionController;
use App\Http\Controllers\Admin\CustomerBillController;
use App\Http\Controllers\Admin\CronJobController;
use App\Http\Controllers\Admin\LoginControllor;
use App\Http\Controllers\Reports\ReportController;

Route::get('/', [HomeController::class, 'index']);
Route::get('inauguration', fn () => view("inauguration"));
Route::get('testSms', [UserRegistrationController::class, 'testSms'])->name("testSms");

Route::post('signUpUser', [UserRegistrationController::class, 'signUpUser'])->name("registration");
Route::get('registration', [UserRegistrationController::class, 'userRegistrartion'])->name('user.registration');
Route::get('organizationVerification/{id}', [UserRegistrationController::class, 'organizationVerification'])->name('organizationVerification');
Route::post('organizationOtpVerification', [UserRegistrationController::class, 'organizationOtpVerification']);

Auth::routes();

Route::get('welcome', fn () => view("admin.organization.welcome-page"));
Route::post('get-organization', [UserRegistrationController::class, 'getOrganization']);

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [UserRegistrationController::class, 'adminDashboard']);
    Route::get('customer/addCustomer', [UserRegistrationController::class, 'addCustomer']);
    Route::post('get-user-by-cnic', [UserRegistrationController::class, 'getUserByCnic'])->name("get-user-by-cnic");
    Route::post('users/save-customer', [UserRegistrationController::class, 'saveCustomer']);
    Route::post('saveCustomerAjax', [UserRegistrationController::class, 'saveCustomerAjax']);

    // Property Cases
    Route::get('settings/list-cases', [PropertyCaseController::class, 'index']);
    Route::get('settings/create-case', [PropertyCaseController::class, 'create']);
    Route::get('settings/edit-case/{id?}', [PropertyCaseController::class, 'edit']);
    Route::post('settings/store', [PropertyCaseController::class, 'store']);
    Route::post('settings/delete-case', [PropertyCaseController::class, 'delete']);
    Route::get('settings/case-details/{id}', [PropertyCaseController::class, 'details']);
    Route::post('save-case-details', [PropertyCaseController::class, 'saveCaseDetails']);
    Route::post('settings/delete-case-details', [PropertyCaseController::class, 'deleteCaseDetails']);

    // Super Admin Routes
    Route::middleware(["super_admin"])->group(function () {
        Route::get('users/manage-admins', [UserRegistrationController::class, 'superadminView']);
        Route::get('users/add-superadmin', [UserRegistrationController::class, 'addSuperAdmin']);
        Route::post('users/save-superadmin', [UserRegistrationController::class, 'saveSuperAdmin']);
        Route::get('users/edit-superadmin/{id}', [UserRegistrationController::class, 'editSuperAdmin']);
        Route::post('users/delete-superadmin', [UserRegistrationController::class, 'deleteSuperAdmin']);
        Route::get('auctions/manage-auction', [CustomerController::class, 'listOpenAuction']);
        Route::get('users-verification', [UserVerificationController::class, 'index']);
        Route::get('users-verification/details/{id?}', [UserVerificationController::class, 'details']);
        Route::post('changeTma', [UserRegistrationController::class, 'changeTma'])->name("changeTma");
    });

    // Admin User Routes
    Route::middleware(["admin_user"])->group(function () {
        Route::get('settings/manage-plaza', [PlazaController::class, 'plazaView'])->name('admin.manage-plaza');
        Route::get('settings/add-plaza', [PlazaController::class, 'addPlaza']);
        Route::post('settings/save-plaza', [PlazaController::class, 'savePlaza']);
        Route::get('settings/edit-plaza/{id}', [PlazaController::class, 'editPlaza']);
        Route::post('settings/delete-plaza', [PlazaController::class, 'deletePlaza']);

        Route::get('settings/manage-plaza-floor/{plaza_id?}', [PlazaFloorController::class, 'plazaFloorView']);
        Route::get('settings/add-plaza-floor/{plaza_id?}', [PlazaFloorController::class, 'addPlazaFloor']);
        Route::post('settings/save-plaza-floor', [PlazaFloorController::class, 'savePlazaFloor']);
        Route::get('settings/edit-plaza-floor/{id}', [PlazaFloorController::class, 'editPlazaFloor']);
        Route::post('settings/delete-plaza-floor', [PlazaFloorController::class, 'deletePlazaFloor']);
        Route::get('settings/manage-attachments', [PlazaFloorController::class, 'manageAttachements']);
        Route::get('settings/shop_details/{id}', [PlazaFloorController::class, 'shopDetails']);
        Route::post('settings/save-attachment', [PlazaFloorController::class, 'saveAttachment']);
        Route::post('settings/delete-attachment', [PlazaFloorController::class, 'deleteAttachment']);
        Route::get('commercial-properties', [PlazaFloorController::class, 'commercialProperties']);
        Route::get('residential-properties', [PlazaFloorController::class, 'residentialProperties']);
        Route::post('get_shops', [PlazaFloorController::class, 'get_shops']);

        Route::get('settings/manage-floor-shops/{plaza_id}/{floor_id}', [PlazaShopsController::class, 'floorShopView']);
        Route::get('settings/add-floor-shop/{plaza_id?}/{floor_id?}', [PlazaShopsController::class, 'addFloorShop']);
        Route::get('residential', [PlazaShopsController::class, 'addResidential']);
        Route::get('editResidential/{id}', [PlazaShopsController::class, 'editResidential']);
        Route::get('edit-residential/{id?}', [PlazaShopsController::class, 'editResidential']);
        Route::post('settings/save-floor-shop', [PlazaShopsController::class, 'saveFloorShop']);
        Route::get('settings/edit-floor-shop/{id}', [PlazaShopsController::class, 'editFloorShop']);
        Route::post('settings/delete-floor-shop', [PlazaShopsController::class, 'deleteFloorShop']);

        // Auctions
        Route::get('auctions/manage-auctions', [AuctionController::class, 'auctionView']);
        Route::get('auctions/add-auctions', [AuctionController::class, 'addAuction']);
        Route::post('auctions/save-auctions', [AuctionController::class, 'saveAuction']);
        Route::get('auctions/edit-auctions/{id}', [AuctionController::class, 'editAuction']);
        Route::post('auctions/delete-auctions', [AuctionController::class, 'deleteAuction']);
        Route::post('auctions/published-auction', [AuctionController::class, 'publishedAuction']);
        Route::get('auctions/manage-auction', [CustomerController::class, 'listOpenAuction']);

        Route::get('printCommercial/{id?}', [PlazaFloorController::class, 'printCommercial']);
        Route::get('printResidential/{id?}', [PlazaFloorController::class, 'printResidential']);
        Route::resource('rent', RentCollectionController::class);
        Route::get('printAllOutstanding', [RentCollectionController::class, 'printAllOutstanding']);
        Route::get('printTenantRecipts/{id?}', [RentCollectionController::class, 'printTenantRecipts']);
        Route::get('printTenantOutstanding/{id?}', [RentCollectionController::class, 'printTenantOutstanding']);
        Route::get('printCases', [PropertyCaseController::class, 'printCases']);
        Route::get('printBankRecipts/{id}', [RentCollectionController::class, 'printBankRecipts']);
        Route::get('getTenants', [UserRegistrationController::class, 'getTenants']);
        Route::get('printAllRecipts', [ReportController::class, 'printAllRecipts']);
        Route::resource('reports', ReportController::class);
        Route::get('printMonthlyReport', [RentCollectionController::class, 'printMonthlyReport']);
        Route::get('printAllByType', [RentCollectionController::class, 'printAllByType']);
        Route::get('view', [PropertyCaseController::class, 'view'])->name("view");
    });

    // Customer Routes
    Route::middleware(["customer"])->group(function () {
        Route::get('auctions/manage-auction', [CustomerController::class, 'listOpenAuction']);
        Route::get('auctions/property-details/{auction_id}/{plaza_id}', [CustomerController::class, 'propertyDetails']);
        Route::get('auctions/add-customer-cdr/{auction_id}/{plaza_shop_id}', [CustomerController::class, 'addCustomerCdr']);
        Route::post('auctions/save-customer-cdr', [CustomerController::class, 'saveCustomerCdr']);
        Route::post('auctions/delete-customer-cdr', [CustomerController::class, 'deleteCustomerCDR']);
        Route::get('customer-dashboard', [UserRegistrationController::class, 'customerDashboards']);
    });

    Route::post('placeBid', [HomeController::class, 'placeBid']);
});

// Public Website Routes
Route::get('property-details/{auction_id}/{plaza_id}', [HomeController::class, 'propertyDetails']);
Route::get('details/{auction_id}/{plaza_id}/{shop_id}', [HomeController::class, 'singlePropertyDetails']);
Route::get('upComingAuctions', [AuctionController::class, 'upComingAuctions']);
Route::get('completedAuctions', [AuctionController::class, 'completedAuctions'])->name('completedAuctions');
Route::get('getMaxBidInfo/{id}/{ids}', [HomeController::class, 'getMaxBidInfo']);
Route::get('makeAuctionExpired/{id}', [HomeController::class, 'makeAuctionExpired']);
Route::get('getOrganizationOffice/{office_id}', [HomeController::class, 'getOrganizationOffice']);
Route::get('printPdfReport/{auction_id}/{shop_id}', [HomeController::class, 'printPdfReport']);
Route::get('sendAnnouncementSms', [AuctionController::class, 'sendAnnouncementSms']);
Route::get('generateRent', [CustomerBillController::class, 'generateRent']);
Route::get('updateCustomerCron', [PlazaShopsController::class, 'updateCustomerCron']);
Route::get('organizationProperty', [RentCollectionController::class, 'organizationProperty']);
Route::get('checkAuctionExpiration', [CronJobController::class, 'checkAuctionExpiration']);
Route::get('/admin/logout', [LoginControllor::class, 'logout']);
