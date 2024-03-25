<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LL_Controller;
use App\Http\Controllers\WashingController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Models\Price;
use App\Models\Region;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Washing;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TimeController;
use App\Utils\Notification;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});



Route::get('/price', function (){

    $price = Price::all();
    return response()->json($price);

});

//Route::get('/washing_list', function (){
//    $washings = Washing::with(['reservations.comments'])->get();
//    return response()->json($washings);
//});

Route::get('/show', [WashingController::class, 'show']);

Route::post('/store', [WashingController::class, 'store']);
Route::get('/words',[LL_Controller::class, 'show']);

//Route::post('employeeRegister', [AuthController::class, 'employeeRegister']);
Route::post('customerRegister', [AuthController::class, 'customerRegister']);
Route::post('employeeRegister', [AuthController::class, 'employeeRegister']);

//Route::post('sendEmployeeOtp',[AuthController::class,'sendEmployeeOtp']);
Route::post('sendCustomerOtp',[AuthController::class,'sendCustomerOtp']);
Route::post('sendEmployeeOtp',[AuthController::class,'sendEmployeeOtp']);
//Route::post('verifyOtp',[AuthController::class,'verifyOTP']);
Route::post('customerVerifyOpt',[AuthController::class,'customerVerifyOpt']);
Route::post('employeeVerifyOpt',[AuthController::class,'employeeVerifyOpt']);
Route::post('/new_update', [WashingController::class, 'new_update']);

Route::middleware('setLocale')->group(function (){
    // get words
    Route::get('/getCustomerWords', [ApiController::class,'getCustomerWords']);
    Route::get('/getEmployeeWords', [ApiController::class,'getEmployeeWords']);
    // terms & conditions
    Route::get('/getCustomerTerm',[ApiController::class,'getCustomerTerm']);
    Route::get('/getEmployeeTerm',[ApiController::class,'getEmployeeTerm']);
    //washings for customer app
    Route::get('/washings',[ApiController::class, 'getAllWashings']);
    Route::post('/washing_change_status',[ApiController::class, 'washing_change_status']);
});


Route::middleware(['auth:sanctum','setLocale'])->group(function(){

    // get payment packages
    Route::get('/packages', [ApiController::class,'packages']);

    //get faqs
    Route::get('/customerFaqs', [ApiController::class, 'customerFaqs']);
    Route::get('/employeeFaqs', [ApiController::class, 'employeeFaqs']);


    // reservations
    Route::group(['prefix' => 'reservations'], function(){

        Route::get('/{id}' ,[ReservationController::class, 'show']);
        Route::post('/add', [ReservationController::class, 'store']);
        Route::post('/customerUpdate/{id}', [ReservationController::class, 'updateCustomerReservation']);

    });

    Route::get('/reservation_list', [ReservationController::class, 'showReservations']);
    Route::post('/employeeChangeStatus', [ReservationController::class, 'employeeChangeStatus']);
    Route::post('/customerChangeStatus', [ReservationController::class, 'customerChangeStatus']);
    Route::get('employee/reservation_list', [ReservationController::class, 'showEmployeeReservations']);
    //users
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('profile', [AuthController::class, 'show']);
    Route::put('profile', [AuthController::class, 'update']);
    Route::delete('profile',[AuthController::class, 'destroy']);

    // Cars
    Route::resource('cars', CarController::class);

    //Comments
    Route::post('/rating/add', [ApiController::class, 'store_comment']);

    // offers
    Route::get('/getCustomerOffers',[ApiController::class,'getCustomerOffers']);
    Route::get('/getEmployeeOffers',[ApiController::class,'getEmployeeOffers']);

    //car bans
    Route::get('/bans', [ApiController::class,'getBans']);

    //services
    Route::get('/services', [ApiController::class, 'getServices']);

    //reservation hours
    Route::get('times/{washing_id}/{date}', [TimeController::class, 'index']);

    //selected washing services by ban_id
    Route::get('/getWashingServices', [ApiController::class, 'getWashingServices']);
//    456/2/27.12.2023


    //all washing for employee app
    Route::get('/getEmployeeWashings', [ApiController::class,'getEmployeeWashings']);

    // get languages
    Route::get('/languages', [ApiController::class,'getLanguages']);

    // get contacts
    Route::get('/contacts', [ApiController::class,'getContacts']);


    Route::get('regions', [ApiController::class, 'getRegions']);


    Route::post('update-fcm', [UserController::class, 'updateFcm']);


    Route::group(['prefix' => 'washings'], function(){

        Route::get('/show', [WashingController::class, 'show']);
        Route::post('/store', [WashingController::class, 'store']);
        Route::post('/update', [WashingController::class, 'update']);
        Route::get('/delete/{id}', [WashingController::class, 'delete']);

    });

    Route::post('/store_payment', [WashingController::class, 'store_payment']);
    Route::get('/payment_history', [WashingController::class, 'payment_history']);

});

Route::get('/notification', function () {

    //first find user  which you will send notification and get user all tokens

    $tokens = \App\Models\FcmToken::where('user_id', 110)->pluck('fcm_token')->toArray();

    //second create notification instance
    $notification = Notification::getInstance();
    //send message with tokens
    if (count($tokens)) {
        $notification->send('2', '1', $tokens);
    }

    return response()->json(['test' => 'true']);

});
