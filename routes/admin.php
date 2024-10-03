<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ComapanyInfoController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductStockController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\TransectionController;
use App\Http\Controllers\OTPController;
use Illuminate\Support\Facades\Route;
Route::group(['middleware' => ['auth:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('home');

    // User Routes
    Route::prefix('user')->as('user.')->group(function () {
        Route::get('/list', [AdminUserController::class, 'index'])->name('list');
        Route::get('/create', [AdminUserController::class, 'create'])->name('create');
        Route::post('/store', [AdminUserController::class, 'store'])->name('store');
        Route::post('/check/{id}', [AdminUserController::class, 'check'])->name('check');

        Route::post('/delete/{id}', [AdminUserController::class, 'delete'])->name('delete');
        Route::get('/edit/{id}', [AdminUserController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [AdminUserController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [AdminUserController::class, 'destroy'])->name('destroy');
        Route::get('/image/remove/{field_name}/{class_name}/{user_id}', [AdminUserController::class, 'imageRemove'])->name('image.remove');

        Route::get('/status/chnage/{user_id}/{status}', [AdminUserController::class, 'changeStatus'])->name('chnage.status');

        Route::prefix('otp')->as('otp.')->group(function () {
            Route::get('/email/otp/check/{user_id}', [OTPController::class, 'index'])->name('index');
            Route::post('/email/otp/check/post', [OTPController::class, 'store'])->name('store');
        });


        // user permission give routes
        Route::post('/permission/give', [AdminUserController::class, 'givePermission'])->name('givePermission');

    });

    // Products Orders Routes
    Route::prefix('order/product')->as('order.')->group(function () {
        Route::get('/', [InvoiceController::class, 'index'])->name('index');
        Route::get('/status/{id}/{status}/{order_status}', [InvoiceController::class, 'status'])->name('status');
    });

    // categories routes
    Route::prefix('categories')->as('category.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [CategoryController::class, 'destroy'])->name('destroy');
    });

    // Sub Category Routes
    Route::prefix('subcategory')->as('subcategory.')->group(function () {
        Route::get('/', [SubCategoryController::class, 'index'])->name('index');
        Route::post('/store', [SubCategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [SubCategoryController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [SubCategoryController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [SubCategoryController::class, 'destroy'])->name('destroy');
    });

    // Products Routes
    Route::prefix('product')->as('product.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::get('/destroy/{id}', [ProductController::class, 'destroy'])->name('destroy');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
        Route::get('/info/item/{id}', [ProductController::class, 'infoItem'])->name('info.item');
        Route::get('/feature/image/remove/{id}', [ProductController::class, 'feature_remove'])->name('feature.image.remove');
        Route::get('/thumbnail/remove/{id}', [ProductController::class, 'thumbnail_remove'])->name('thumbnail.remove');
        Route::put('/update/{id}', [ProductController::class, 'update'])->name('update');
    });

    // All Stock Routes
    Route::prefix('stock')->as('stock.')->group(function () {
        Route::get('/', [ProductStockController::class, 'index'])->name('index');
        Route::get('/create', [ProductStockController::class, 'create'])->name('create');
        Route::post('/store', [ProductStockController::class, 'store'])->name('store');
        Route::get('/destroy/{id}', [ProductStockController::class, 'destroy'])->name('destroy');
        Route::get('/edit/{id}', [ProductStockController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [ProductStockController::class, 'update'])->name('update');
    });

    // All Transection Routes
    Route::prefix('transaction')->as('transaction.')->group(function () {
        Route::get('/', [TransectionController::class, 'index'])->name('index');
        Route::get('/destroy/{id}', [TransectionController::class, 'destroy'])->name('destroy');
        Route::get('/edit/{id}', [TransectionController::class, 'edit'])->name('edit');
    });

    // Comapny settings routes
    Route::prefix('settings')->as('settings.')->group(function () {
        Route::get('/company-info', [ComapanyInfoController::class, 'index'])->name('index');
        Route::post('/company-info/logo/store', [ComapanyInfoController::class, 'logoUpdate'])->name('logo.store');
        Route::get('/company-info/logo/remove/{field_name}', [ComapanyInfoController::class, 'logoRemove'])->name('logo.remove');
        Route::post('/company-info/details/store', [ComapanyInfoController::class, 'companyDetails'])->name('company.details.store');

        // Social Media Routes
        Route::post('/site/social/store', [ComapanyInfoController::class, 'socialStore'])->name('social.store');
        Route::post('/site/genarel/store', [ComapanyInfoController::class, 'genarelsettingStore'])->name('genarelSetting.store');

        Route::prefix('home')->as('home.')->group(function () {
            Route::get('/home-page', [PageController::class, 'index'])->name('index');
            Route::post('/home-page/banner/store', [PageController::class, 'bannerStore'])->name('banner.store');

            Route::post('/home-page/banner/one/store', [PageController::class, 'bannerOneStore'])->name('banner.one.store');
            Route::post('/home-page/banner/two/store', [PageController::class, 'bannerTwoStore'])->name('banner.two.store');
            Route::post('/home-page/banner/three/store', [PageController::class, 'bannerThreeStore'])->name('banner.three.store');
            Route::post('/home-page/banner/four/store', [PageController::class, 'bannerFourStore'])->name('banner.four.store');
            Route::post('/home-page/banner/five/store', [PageController::class, 'bannerFiveStore'])->name('banner.five.store');

            Route::get('/home-page/banner/remove/{id}/{class_name}', [PageController::class, 'BannerRemove'])->name('banner.remove');
            // Route::post('/company-info/details/store', [ComapanyInfoController::class, 'companyDetails'])->name('company.details.store');
        });

        // Country Routes
        Route::prefix('country')->as('country.')->group(function () {
            Route::get('/', [CountryController::class, 'index'])->name('index');
            Route::get('/create', [CountryController::class, 'create'])->name('create');
            Route::post('/store', [CountryController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [CountryController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [CountryController::class, 'update'])->name('update');
            Route::get('/destroy/{id}', [CountryController::class, 'destroy'])->name('destroy');
        });

        // Division Routes
        Route::prefix('division')->as('division.')->group(function () {
            Route::get('/', [CountryController::class, 'division_index'])->name('index');
            Route::post('/store', [CountryController::class, 'division_store'])->name('store');
            Route::get('/edit/{id}', [CountryController::class, 'division_edit'])->name('edit');
            Route::post('/update/{id}', [CountryController::class, 'division_update'])->name('update');
            Route::get('/destroy/{id}', [CountryController::class, 'division_remove'])->name('destroy');
        });

        // District Routes
        Route::prefix('district')->as('district.')->group(function () {
            Route::get('/', [CountryController::class, 'district_index'])->name('index');
            Route::post('/store', [CountryController::class, 'district_store'])->name('store');
            Route::get('/edit/{id}', [CountryController::class, 'district_edit'])->name('edit');
            Route::post('/update/{id}', [CountryController::class, 'district_update'])->name('update');
            Route::get('/destroy/{id}', [CountryController::class, 'district_remove'])->name('destroy');
        });

        // Upzila Routes
        Route::prefix('upzila')->as('upzila.')->group(function () {
            Route::get('/', [CountryController::class, 'upzila_index'])->name('index');
            Route::post('/store', [CountryController::class, 'upzila_store'])->name('store');
            Route::get('/edit/{id}', [CountryController::class, 'upzila_edit'])->name('edit');
            Route::post('/update/{id}', [CountryController::class, 'upzila_update'])->name('update');
            Route::get('/destroy/{id}', [CountryController::class, 'upzila_remove'])->name('destroy');
        });

        // Upzila Routes
        Route::prefix('union')->as('union.')->group(function () {
            Route::get('/', [CountryController::class, 'union_index'])->name('index');
            Route::post('/store', [CountryController::class, 'union_store'])->name('store');
            Route::get('/edit/{id}', [CountryController::class, 'union_edit'])->name('edit');
            Route::post('/update/{id}', [CountryController::class, 'union_update'])->name('update');
            Route::get('/destroy/{id}', [CountryController::class, 'union_remove'])->name('destroy');
        });

        // State Routes
        Route::prefix('state')->as('state.')->group(function () {
            Route::get('/', [StateController::class, 'index'])->name('index');
            Route::get('/create', [StateController::class, 'create'])->name('create');
            Route::post('/store', [StateController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [StateController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [StateController::class, 'update'])->name('update');
            Route::get('/destroy/{id}', [StateController::class, 'destroy'])->name('destroy');
        });

        // Notice Routes
        Route::prefix('notice')->as('notice.')->group(function () {
            Route::get('/', [ComapanyInfoController::class, 'noticeIndex'])->name('index');
            Route::post('/store', [ComapanyInfoController::class, 'noticeStore'])->name('store');
            Route::get('/delete/{id}', [ComapanyInfoController::class, 'noticeDelete'])->name('notice-delete');
            Route::get('/edit/{id}', [ComapanyInfoController::class, 'noticeEdit'])->name('notice-edit');
            Route::post('/update', [ComapanyInfoController::class, 'noticeUpdate'])->name('update');
            Route::get('/inactive/{id}', [ComapanyInfoController::class, 'inActive'])->name('notice.inactive');
            Route::get('/active/{id}', [ComapanyInfoController::class, 'active'])->name('notice.active');
        });

    });

});
