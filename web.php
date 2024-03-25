<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BanController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LL_Controller;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\VisionController;
use App\Http\Controllers\WordController;
use App\Models\Region;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WashingController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ReservationController;
use Intervention\Image\Facades\Image;
use App\Utils\UserNotification;

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

Route::get('/optimize', function(){
    artisan::call('optimize:clear');
});

Route::get('/status', function(){
    artisan::call('change:status');
});

Route::get('/migrate', function(){
    artisan::call('migrate');
});




Route::get('/test', function () {
    //first find user  which you will send notification and get user all tokens
    $tokens = \App\Models\FcmToken::where('user_id', 110)->pluck('fcm_token')->toArray();

    //second create notification instance
    $notification = UserNotification::getInstance();
    //send message with tokens
    if (count($tokens)) {
        $notification->send('Sifariş ləğv edildi', 'body', $tokens);
    }

    return response()->json(['test' => 'true']);

});

Route::get('admin/admin_exit', [AuthController::class, 'admin_exit'])->name('admin_exit');
Route::get('admin', [AuthController::class, 'index'])->name('admin_login');
Route::post('admin/login_submit', [AuthController::class, 'login_submit'])->name('admin_submit');


Route::group(['middleware' => 'administrator', 'prefix' => LaravelLocalization::setLocale() . '/admin'], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin_dashboard');
    Route::get('profile', [UserController::class, 'index'])->name('admin_profile');
    Route::post('update/{id}', [UserController::class, 'update'])->name('admin_update');

    Route::group(['prefix' => 'washing'], function () {
        Route::get('/', [WashingController::class, 'index'])->name('washing');
        Route::post('/add', [WashingController::class, 'store'])->name('washing_add');
        Route::get('/edit/{id}', [WashingController::class, 'edit'])->name('washing_edit');
        Route::post('/update/{id}', [WashingController::class, 'update_admin_washing'])->name('washing_update');
        Route::get('/delete/{id}', [WashingController::class, 'delete'])->name('washing_delete');
    });


    Route::group(['prefix' => 'price'], function () {
        Route::get('/', [PriceController::class, 'index'])->name('price');
        Route::post('/add', [PriceController::class, 'store'])->name('price_add');
        Route::get('/edit/{id}', [PriceController::class, 'edit'])->name('price_edit');
        Route::post('/update/{id}', [PriceController::class, 'update'])->name('price_update');
        Route::get('/delete/{id}', [PriceController::class, 'delete'])->name('price_delete');
    });


    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'show'])->name('users');
    });

    Route::group(['prefix' => 'reservation'], function () {
        Route::get('/', [ReservationController::class, 'index'])->name('reservation');
    });

    Route::group(['prefix' => 'city'], function () {
        Route::get('/', [RegionController::class, 'show_city'])->name('city');
        Route::post('/add', [RegionController::class, 'store_city'])->name('city_add');
        Route::get('/edit/{id}', [RegionController::class, 'edit_city'])->name('city_edit');
        Route::post('/update/{id}', [RegionController::class, 'update_city'])->name('city_update');
        Route::get('/delete/{id}', [RegionController::class, 'delete_city'])->name('city_delete');
    });


    Route::group(['prefix' => 'region'], function () {
        Route::get('/{id}', [RegionController::class, 'show_region'])->name('region');
        Route::post('/add', [RegionController::class, 'store_region'])->name('region_add');
        Route::get('/edit/{id}', [RegionController::class, 'edit_region'])->name('region_edit');
        Route::post('/update/{id}', [RegionController::class, 'update_region'])->name('region_update');
        Route::get('/delete/{id}', [RegionController::class, 'delete_region'])->name('region_delete');
    });


    Route::group(['prefix' => 'village'], function () {
        Route::get('/{id}', [RegionController::class, 'show_village'])->name('village');
        Route::post('/add', [RegionController::class, 'store_village'])->name('village_add');
        Route::get('/edit/{id}', [RegionController::class, 'edit_village'])->name('village_edit');
        Route::post('/update/{id}', [RegionController::class, 'update_village'])->name('village_update');
        Route::get('/delete/{id}', [RegionController::class, 'delete_village'])->name('village_delete');
    });



    Route::group(['prefix' => 'll'], function () {
        Route::get('/', [LL_Controller::class, 'index'])->name('ll_list');
        Route::post('/add', [LL_Controller::class, 'store'])->name('ll_add');
        Route::get('/edit/{id}', [LL_Controller::class, 'edit'])->name('ll_edit');
        Route::post('/update/{id}', [LL_Controller::class, 'update'])->name('ll_update');
        Route::get('/delete/{id}', [LL_Controller::class, 'delete'])->name('ll_delete');
    });

    Route::resource('offers', OfferController::class);
    Route::resource('terms', TermController::class);
    Route::resource('bans', BanController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('faqs', FaqController::class);
    Route::resource('languages', LanguageController::class);
    Route::resource('contacts', ContactController::class);
    Route::resource('words', WordController::class);
    Route::resource('blogs', BlogController::class);
    Route::resource('suggestions', SuggestionController::class);
    Route::resource('heroes', HeroController::class);
    Route::resource('packages', PackageController::class);
    Route::resource('statistics', StatisticController::class);
    Route::resource('abouts', AboutController::class);
    Route::resource('visions', VisionController::class);

    Route::delete('/images/{id}', [WashingController::class, 'destroy'])->name('admin_images_delete');



});



Route::group(['prefix' => LaravelLocalization::setLocale()], function (){

    Route::get('/change-locale/{locale}', [FrontController::class, 'changeLocale'])->name('change.locale');
    // Route::get('/', [FrontController::class,'welcome'])->name('welcome');

    Route::get('/services', [FrontController::class,'services'])->name('services');
    Route::get('/blogs', [FrontController::class,'blogs'])->name('blogs');
    Route::get('/branches', [FrontController::class,'branches'])->name('branches');
    Route::get('/search', [FrontController::class,'branches'])->name('search');
    Route::get('/about', [FrontController::class,'about'])->name('about');

    Route::get('{slug}', [FrontController::class,'dynamicPage'])->name('dynamic.page');


});
