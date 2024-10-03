<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Customer\DataEntryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ComapanyInfoController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\OTPController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::prefix('ajax')->as('ajax.')->group(function () {
    Route::get('/username/check/{username}', [AjaxController::class, 'username_check'])->name('username.check');
    Route::get('/refer-username/check/{username}', [AjaxController::class, 'refer_username'])->name('referusername.check');
    Route::get('/agent-username/check/{username}', [AjaxController::class, 'agent_username'])->name('agent_username.check');


    Route::get('get/states/{id}', [AjaxController::class, 'get_states'])->name('get.states');
    Route::get('get/district/{division}', [AjaxController::class, 'get_districts'])->name('get.district');
    Route::get('get/upazila/{district}', [AjaxController::class, 'get_upazilas'])->name('get.upazila');
    Route::get('get/union/{upazila}', [AjaxController::class, 'get_unions'])->name('get.union');
    Route::get('get/village/{union}', [AjaxController::class, 'get_villages'])->name('get.village');

    Route::get('get/user/documents/{id}', [AjaxController::class, 'get_user_documents'])->name('get.user_documents');

    // Marchent Data
    Route::get('get/marchent/data/{id}', [AjaxController::class, 'getMarchentData'])->name('get.getMarchentData');

    // Get User Info
    Route::get('get/user/data/{id}', [AjaxController::class, 'getUserInfo'])->name('get.UserDataView');

    // Get All Designations
    Route::get('get/all/designation', [AjaxController::class, 'getDesignation'])->name('get.designation');

    Route::get('get/all/user/count', [AjaxController::class, 'getAllUserCount'])->name('get.allUserCount');

    Route::get('get/all/products', [AjaxController::class, 'getAllProducts'])->name('get.products');


    Route::get('invoice/view/{id}', [AjaxController::class, 'invoice_view'])->name('invoice_view');

    Route::prefix('address-book')->as('address_book.')->group(function () {
        Route::get('/get/address-book/data', [AjaxController::class, 'get_address_book_data'])->name('get_address_book_data');
        Route::post('/address_book_insert', [AjaxController::class, 'address_book_insert'])->name('address_book_insert');
        Route::get('/get_address_book_data_for_edit/{id}', [AjaxController::class, 'get_address_book_data_for_edit'])->name('get_address_book_data_for_edit');
        Route::get('/get_address_book_data_for_destroy/{id}', [AjaxController::class, 'get_address_book_data_for_destroy'])->name('get_address_book_data_for_destroy');
    });
});

// Checkout Routes
Route::prefix('ajax')->as('ajax.')->group(function () {
    Route::get('/username/check/{username}', [AjaxController::class, 'username_check'])->name('username.check');
    Route::get('/refer-username/check/{username}', [AjaxController::class, 'refer_username'])->name('referusername.check');
    Route::get('/agent-username/check/{username}', [AjaxController::class, 'agent_username'])->name('agent_username.check');


    Route::get('get/states/{id}', [AjaxController::class, 'get_states'])->name('get.states');
    Route::get('get/district/{division}', [AjaxController::class, 'get_districts'])->name('get.district');
    Route::get('get/upazila/{district}', [AjaxController::class, 'get_upazilas'])->name('get.upazila');
    Route::get('get/union/{upazila}', [AjaxController::class, 'get_unions'])->name('get.union');
    Route::get('get/village/{union}', [AjaxController::class, 'get_villages'])->name('get.village');

    Route::get('get/user/documents/{id}', [AjaxController::class, 'get_user_documents'])->name('get.user_documents');

    // Marchent Data
    Route::get('get/marchent/data/{id}', [AjaxController::class, 'getMarchentData'])->name('get.getMarchentData');

    // Get User Info
    Route::get('get/user/data/{id}', [AjaxController::class, 'getUserInfo'])->name('get.UserDataView');

    // Get All Designations
    Route::get('get/all/designation', [AjaxController::class, 'getDesignation'])->name('get.designation');

    Route::get('get/all/user/count', [AjaxController::class, 'getAllUserCount'])->name('get.allUserCount');

    Route::get('get/all/products', [AjaxController::class, 'getAllProducts'])->name('get.products');


    Route::get('invoice/view/{id}', [AjaxController::class, 'invoice_view'])->name('invoice_view');

    Route::prefix('address-book')->as('address_book.')->group(function () {
        Route::get('/get/address-book/data', [AjaxController::class, 'get_address_book_data'])->name('get_address_book_data');
        Route::post('/address_book_insert', [AjaxController::class, 'address_book_insert'])->name('address_book_insert');
        Route::get('/get_address_book_data_for_edit/{id}', [AjaxController::class, 'get_address_book_data_for_edit'])->name('get_address_book_data_for_edit');
        Route::get('/get_address_book_data_for_destroy/{id}', [AjaxController::class, 'get_address_book_data_for_destroy'])->name('get_address_book_data_for_destroy');
    });
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('get/users', [AjaxController::class, 'getUsers'])->name('get.users');
Route::get('get/branchs', [AjaxController::class, 'getBranchs'])->name('get.branchs');
Route::get('get/category', [AjaxController::class, 'get_category'])->name('get.category');
Route::get('get/subcategory/{id}', [AjaxController::class, 'get_subcategory'])->name('get.subcategory');

Route::get('get/tele_code/{id}', [AjaxController::class, 'get_tele_code'])->name('ajax.get.tele_code');
Route::get('get/rank', [AjaxController::class, 'get_rank'])->name('get.rank');



require __DIR__ . '/admin.php';
require __DIR__ . '/adminauth.php';
