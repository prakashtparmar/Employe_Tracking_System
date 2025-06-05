<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\MapController;

Route::get('/', function () {
    return view('admin.login');
});



Route::prefix('admin')->group(function() {
    //Show Login Form
    Route::get('login', [AdminController::class, 'create'])->name('admin.login');

    //Handle Login Form Submission
    Route::post('login', [AdminController::class, 'store'])->name('admin.login.request');
    
    Route::group(['middleware' => ['admin']], function (){

    //Dashboard Route
        Route::resource('dashboard', AdminController::class)->only(['index']);
    //Display Update Password Page  
        Route::get('update-password', [AdminController::class, 'edit'])->name('admin.update-password');
    //Verify Password    
        Route::post('verify-password', [AdminController::class, 'verifyPassword'])->name('admin.verify.password');
    //Update Password
        Route::post('admin/update-password', [AdminController::class, 'updatePasswordRequest'])->name('admin.update-password.request');
    
    //Display & Update Admin Details
        Route::get('update-details', [AdminController::class, 'editdetails'])->name('admin.update-details');
    
    //Update Admin Detail    
        
        Route::post('update-details', [AdminController::class, 'updateDetails'])->name('admin.update-details.request');
        
    //Sub Admin    
        Route::get('subadmins', [AdminController::class, 'subadmins']);

    
    //Delete Image
        Route::post('delete-profile-image', [AdminController::class, 'deleteProfileImage']);
    
    //Togle Action Active InActive    
    Route::post('update-subadmin-status', [AdminController::class, 'updateSubadminStatus']);
    Route::get('add-edit-subadmin/{id?}', [AdminController::class, 'addEditSubadmin']);
    Route::post('add-edit-subadmin/request', [AdminController::class, 'addEditSubadminRequest']);
    Route::get('delete-subadmin/{id}', [AdminController::class, 'deleteSubadmin']);

    //Update Subadmin Access
    Route::get('/update-role/{id}', [AdminController::class, 'updateRole']);
    Route::post('/update-role/request', [AdminController::class, 'updateRoleRequest']);

    //Category Route handle all category releted operation
    Route::resource('categories', CategoryController::class);
    Route::post('update-category-status', [CategoryController::class, 'updateCategoryStatus']);

    Route::post('delete-category-image', [CategoryController::class, 'deleteCategoryImage']);
    Route::post('delete-sizechart-image', [CategoryController::class, 'deleteSizechartImage']);


    //Product Route handle all product related operation
    Route::resource('products', ProductController::class);
    Route::post('update-product-status', [ProductController::class, 'updateProductStatus']);
    Route::post('/product/upload-image', [ProductController::class, 'uploadImage'])->name('product.upload.image');
    Route::post('/product/upload-images', [ProductController::class, 'uploadImages'])->name('product.upload.images');
    Route::post('/product/delete-temp-image', [ProductController::class, 'deleteTempImage'])->name('product.delete.temp.image');
    Route::get('delete-product-image/{id?}', [ProductController::class, 'deleteProductImage']);
    Route::post('/product/upload-video', [ProductController::class, 'uploadVideo'])->name('product.upload.video');
    Route::get('/delete-product-main-image/{id?}', [ProductController::class, 'deleteProductMainImage']);
    Route::get('/delete-product-video/{id}', [ProductController::class, 'deleteProductVideo']);



    //Map Route
    Route::get('/', function () {return view('welcome');});
    Route::get('map', [MapController::class, 'map'])->name('map');


    //Admin Logout
    Route::get('logout', [AdminController::class, 'destroy'])->name('admin.logout');

    });
    
});

