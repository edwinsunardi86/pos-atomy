<?php

use App\Http\Controllers\AgingARController;
use App\Http\Controllers\AgingARProgressController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactClientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileUserController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\UploadController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::group(['scheme'=>'https'],function(){
//     Route::get('/', [LoginController::class,'index'])->middleware('guest')->name('login');
//     Route::post('/login', [LoginController::class, 'authentication']);
//     Route::post('/logout', [LoginController::class, 'signout'])->name('logout');
//     Route::post('/forgotPassword',[UserController::class,'forgotPassword']);
//     Route::get('/forgetChangePassword/{token}',[UserController::class,'SessionForgetToPasswordchangePassword'])->middleware('guest');

//     Route::get('/dashboard_v1', [DashboardController::class,'dashboard_v1'])->middleware('auth');
//     Route::get('/linkstorage', function () {
//         Artisan::call('storage:link');
//     });
// });
Route::get('/', [LoginController::class,'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'authentication']);
Route::post('/logout', [LoginController::class, 'signout'])->name('logout');
Route::post('/forgotPassword',[UserController::class,'forgotPassword']);
Route::get('/forgetChangePassword/{token}',[UserController::class,'SessionForgetToPasswordchangePassword'])->middleware('guest');
Route::post('/changePasswordByToken',[UserController::class,'changePasswordByToken'])->middleware('guest');
Route::get('/dashboard_v1', [DashboardController::class,'dashboard_v1'])->middleware('auth');
Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

// Simple public ping route to verify the framework is responding (no middleware)
Route::get('/ping', function () {
    return response('ok', 200)->header('Content-Type', 'text/plain');
});

// Temporary debug route (no middleware) to call the controller method directly
Route::get('/debug/products/dataTableProduct', [ProductController::class, 'dataTableProduct']);

Route::group(['middleware' => ['auth','authorization'],'prefix'=>'users'], function() {
    Route::get('/', [UserController::class,'index']);
    Route::get('/create_user', [UserController::class,'create_user']);
    Route::post('/store_user',[UserController::class,'store_user']);
    Route::get('/detail/{username}', [UserController::class,'detail_user']);
    Route::get('/edit_user/{username}', [UserController::class,'edit_user']);
    Route::post('/update_user', [UserController::class,'update_user']);
    Route::get('/access/{id}',[UserController::class,'usersAccess']);
    Route::post('/set_user_access_previlage',[UserController::class,'setUserAccessPrevilage']);
    Route::post('/setUserAccessAuthority',[UserController::class,'setUserAccessAuthority']);
    Route::post('/setDataAccess',[UserController::class,'setDataAccess']);
});


Route::get('/change_password',[ProfileUserController::class,'viewChangePassword'])->middleware('auth');
Route::post('/change_password',[ProfileUserController::class,'changeSelfPassword'])->middleware('auth');

Route::group(['middleware' => ['auth','authorization']], function() {
    
    // Correct route name -> controller method mismatch: use existing `dataTableProduct`
    
});

Route::group(['middleware' => ['auth','authorization']], function() {
    Route::post('/products/dataTableProduct', [ProductController::class, 'dataTableProduct'])->name('products.dataTableProduct');
    Route::resource('products', ProductController::class);
    Route::get('/purchase_orders/searchDataProduct',[ProductController::class, 'searchDataProduct'])->name('purchase_orders.searchDataProduct');
    Route::resource('/purchase_orders', PurchaseOrderController::class);
    Route::post('/purchase_orders/dataTablePurchaseOrders',[PurchaseOrderController::class, 'dataTablePurchaseOrders'])->name('purchase_orders.dataTablePurchaseOrders');
});

Route::get('/dashboard_v1/dt_reminder_next_follow_up_date', [DashboardController::class, 'dtReminderNextFollowUpDate']);
Route::post('/dashboard_v1/json_handling_invoice',[DashboardController::class,'jsonHandlingInvoice']);

