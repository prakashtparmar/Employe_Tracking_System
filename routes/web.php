<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\TripController;

// Public Login Page
Route::get('/', function () {
    return view('admin.login');
});

Route::prefix('admin')->group(function () {

    // Login
    Route::get('login', [AdminController::class, 'create'])->name('admin.login');
    Route::post('login', [AdminController::class, 'store'])->name('admin.login.request');

    Route::group(['middleware' => ['admin']], function () {

        // Dashboard
        Route::resource('dashboard', AdminController::class)->only(['index']);

        // Admin Profile & Password
        Route::get('update-password', [AdminController::class, 'edit'])->name('admin.update-password');
        Route::post('verify-password', [AdminController::class, 'verifyPassword'])->name('admin.verify.password');
        Route::post('admin/update-password', [AdminController::class, 'updatePasswordRequest'])->name('admin.update-password.request');
        Route::get('update-details', [AdminController::class, 'editdetails'])->name('admin.update-details');
        Route::post('update-details', [AdminController::class, 'updateDetails'])->name('admin.update-details.request');
        Route::post('delete-profile-image', [AdminController::class, 'deleteProfileImage']);

        // Sub-admin Management
        Route::get('subadmins', [AdminController::class, 'subadmins']);
        Route::post('update-subadmin-status', [AdminController::class, 'updateSubadminStatus']);
        Route::get('add-edit-subadmin/{id?}', [AdminController::class, 'addEditSubadmin']);
        Route::post('add-edit-subadmin/request', [AdminController::class, 'addEditSubadminRequest']);
        Route::get('delete-subadmin/{id}', [AdminController::class, 'deleteSubadmin']);

        // Sub-admin Role Management
        Route::get('update-role/{id}', [AdminController::class, 'updateRole']);
        Route::post('update-role/request', [AdminController::class, 'updateRoleRequest']);

        // Categories
        Route::resource('categories', CategoryController::class);
        Route::post('update-category-status', [CategoryController::class, 'updateCategoryStatus']);
        Route::post('delete-category-image', [CategoryController::class, 'deleteCategoryImage']);
        Route::post('delete-sizechart-image', [CategoryController::class, 'deleteSizechartImage']);

        // Products
        Route::resource('products', ProductController::class);
        Route::post('update-product-status', [ProductController::class, 'updateProductStatus']);
        Route::post('/product/upload-image', [ProductController::class, 'uploadImage'])->name('product.upload.image');
        Route::post('/product/upload-images', [ProductController::class, 'uploadImages'])->name('product.upload.images');
        Route::post('/product/delete-temp-image', [ProductController::class, 'deleteTempImage'])->name('product.delete.temp.image');
        Route::get('delete-product-image/{id?}', [ProductController::class, 'deleteProductImage']);
        Route::post('/product/upload-video', [ProductController::class, 'uploadVideo'])->name('product.upload.video');
        Route::get('/delete-product-main-image/{id?}', [ProductController::class, 'deleteProductMainImage']);
        Route::get('/delete-product-video/{id}', [ProductController::class, 'deleteProductVideo']);

        // Trips
        Route::resource('trips', TripController::class);

        Route::get('trip/{id}', [TripController::class, 'show']);
        Route::get('add-edit-trip/{id}', [TripController::class, 'edit']);
        Route::post('update-trip/{id}', [TripController::class, 'update']);

        Route::get('trips/approve/{id}', [TripController::class, 'approve']);
       // Route::post('trips/deny', [TripController::class, 'deny']);
        Route::post('/admin/trips/deny', [TripController::class, 'deny'])->name('admin.trips.deny');





        // Logout
        Route::get('logout', [AdminController::class, 'destroy'])->name('admin.logout');

        // Optional (Uncomment if needed later)
        // Route::post('trips/{trip}/locations', [TripLocationController::class, 'store'])->name('trip.locations.store');
        // Route::get('trips/{trip}/locations', [TripLocationController::class, 'index'])->name('trip.locations.index');
        // Route::post('trips/{trip}/media', [TripMediaController::class, 'store'])->name('trip.media.store');
    });
});
