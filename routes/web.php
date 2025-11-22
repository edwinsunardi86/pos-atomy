<?php

use App\Http\Controllers\AgingARController;
use App\Http\Controllers\AgingARProgressController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactClientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileUserController;
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
    Route::get('/data_company',[AgingARController::class,'getDataCompany']);
    Route::post('/branch_admin',[AgingARController::class,'get_branch_admin']);
    Route::get('/get_user_company_branches/{id}',[UserController::class,'getUserCompanyBranches']);
});


Route::get('/change_password',[ProfileUserController::class,'viewChangePassword'])->middleware('auth');
Route::post('/change_password',[ProfileUserController::class,'changeSelfPassword'])->middleware('auth');
Route::get('/cron_retrieve_invoice',[AgingARController::class,'cron_retrieve_invoice']);

Route::group(['middleware' => ['auth', 'authorization'], 'prefix'=>'aging_ar'],function(){
    Route::get('/company',[AgingARController::class,'getDataCompany']);
    Route::get('/',[AgingARController::class,'index']);
    Route::post('/branch',[AgingARController::class,'get_branch']);
    Route::post('/branch_admin',[AgingARController::class,'get_branch_admin']);
    Route::post('/dt_aging_ar',[AgingARController::class,'datatable_aging_ar']);
    Route::post('/add',[AgingARProgressController::class,'create_AgingArProgressController']);
    Route::post('/export_aging_ar',[AgingARController::class,'export_aging_ar']);
    Route::get('/detail_aging_ar/{id}',[AgingARController::class,'detail_aging_ar']);
    Route::post('/getContactClient',[AgingARController::class,'getContactClient']);
});

Route::group(['middleware' => ['auth', 'authorization'], 'prefix'=>'category'],function(){
    Route::get('/',[CategoryController::class,'index']);
});

Route::get('/dt_category',[CategoryController::class,'datatable_category']);


Route::group(['middleware'=>['auth','authorization'],'prefix'=>'category'], function(){
    Route::post('/add',[CategoryController::class, 'addCategory']);
    Route::post('/update/{id}',[CategoryController::class, 'editCategory']);
    Route::post('/delete',[CategoryController::class, 'deleteCategory']);
});

Route::get('category/getCategory',[CategoryController::class, 'getCategory']);

Route::group(['middleware'=>['auth','authorization'],'prefix'=>'upload'], function(){
    Route::get('/',[UploadController::class, 'view_upload']);
    Route::post('/upload_contact_client',[UploadController::class,'UploadContactClient'])->name('upload.contact_client');
    Route::post('/store_data_by_upload_contract',[UploadController::class,'storeDataByUploadContactClient'])->name('store.data_upload');
});

Route::group(['middleware'=>['auth','authorization'],'prefix'=>'data_contact'], function(){
    Route::get('/dataTableContactClient',[ContactClientController::class,'dataTableContactClient'])->name('datatable.data_contact_client');
    Route::get('/contact_client',[ContactClientController::class,'viewDataContactClient']);
    Route::get('/addContactClient',[ContactClientController::class,'viewAddContactClient']);
    Route::post('/dataClientByClientName',[ContactClientController::class,'dataClientByClientName']);
    Route::post('/dataProjectByProjectCode',[ContactClientController::class,'dataProjectByProjectCode']);
    Route::post('/addDataPICClient',[ContactClientController::class,'addDataPICClient']);
    Route::get('/editContactClient/{id}',[ContactClientController::class,'editContactClient']);
    Route::post('/editDataPICClient',[ContactClientController::class,'editDataPICClient']);
});

Route::group(['middleware'=>['auth','authorization'],'prefix'=>'log'], function(){
    Route::get('/log_progress_aging_ar',[AgingARProgressController::class,'logAgingProgressAR']);
    Route::post('/dt_log_progress_aging_ar',[AgingARProgressController::class,'dataTableLogAgingProgressAR']);
    Route::post('/view_log_per_invoice_number',[AgingARProgressController::class,'viewLogPerInvoiceNumber']);
    Route::get('/refresh_status_aging_ar',[AgingARProgressController::class,'refreshStatusAgingAR']);
    Route::post('/filter_client',[AgingARProgressController::class,'filterClient']);
    Route::post('/export_log_per_invoice_number',[AgingARProgressController::class,'exportLogPerInvoiceNumber']);
    Route::post('/last_follow_up_invoice_number',[AgingARProgressController::class,'getLastFollowUpInvoiceNumber']);
    Route::get('/fetch_follow_up_date',[AgingARProgressController::class,'fetchNotificationFollowUp']);
});

Route::get('/dashboard_v1/dt_reminder_next_follow_up_date', [DashboardController::class, 'dtReminderNextFollowUpDate']);
Route::post('/dashboard_v1/json_handling_invoice',[DashboardController::class,'jsonHandlingInvoice']);
