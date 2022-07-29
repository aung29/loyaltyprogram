<?php

use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

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



Route::get('/', [AdminLoginController::class,'loginPage']);
Route::post('/admin',[AdminLoginController::class,'loginForm']);
Route::get('/logout', [AdminLoginController::class, 'logout']);

Route::group(['middleware' => ['checkAdmin']], function () {
    Route::group(['middleware' => ['checkadminRole']], function () {
        Route::get('/dashboard',[DashboardController::class,'index']);

        Route::get('/analytics',[AnalyticsController::class,'index']);

       
        Route::post('/searchDaily',[SearchController::class,'searchDailyData']);
        Route::post('/searchAnalytics',[SearchController::class,'searchAnalytics']);
       

        });

        Route::resource('/sale', TransactionController::class);
        Route::resource('/customer', CardController::class);
        Route::resource('/membership', MembershipController::class);
        Route::resource('/setting', SettingController::class);
        Route::post('/confirm', [SaleController::class, 'confirmData']);
        Route::get('/export',[ExportController::class,'exportData']);
    //   Search Sale
        Route::post('/searchCardId',[SearchController::class,'searchCard']);
        Route::post('/searchCustomer',[SearchController::class,'searchCustomer']);
        Route::post('/searchReference',[SearchController::class,'searchByReference']);

    //  Search Customer
         Route::post('/searchCustomerCard',[SearchController::class,'searchCustomerCard']);
         Route::post('/changeCustomer',[SearchController::class,'changeCustomer']);
         Route::post('/changeReference',[SearchController::class,'changeReference']);

    // Search Member
         Route::post('/searchMembership',[SearchController::class,'searchMember']);

         
         
       
        
        
       
      
        
      
        
    });












// Route::get('/userUpdate',function(){
//     return view('admin/updateaccount');
// });