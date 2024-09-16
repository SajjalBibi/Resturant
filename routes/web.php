<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Frontend\webController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Frontend\categoryController as FrontendcategoryController;
use App\Http\Controllers\Frontend\menuController as FrontendmenuController;
use App\Http\Controllers\Frontend\reservationController as FrontendreservationController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TestimonaialController;
use App\Http\Controllers\FeedbackAnalyticsController;
use App\Http\Controllers\Frontend\ContactController;
// payment with stripe//
use App\Http\Controllers\StripeController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::get('/create/contact', [ContactController::class, 'create'])->name('create');
Route::post('/store/contact', [ContactController::class, 'store'])->name('contact.store');
// web
Route::get('/web', 'Frontend\webController@web')->name('web.index');
// Frontend
Route::get('/cate', [FrontendcategoryController::class, 'index'])->name('cate.index');
Route::get('/cate/{id}', [FrontendcategoryController::class, 'show'])->name('cate.show');
Route::get('/menu', [FrontendmenuController::class, 'index'])->name('menu.index');


// regiter
Route::get('register','Auth\AuthController@showRegister')->name('register');
Route::post('register','Auth\AuthController@postRegister')->name('register.post');
    
// login
Route::get('login','Auth\AuthController@showlogin')->name('login');
Route::post('login','Auth\AuthController@postlogin')->name('login.post');
Route::get('logout','Auth\AuthController@logout')->name('logout');

// forget password
route::get('/forget' ,'Auth\AuthController@forgetpasswordload');
route::post('/forgetpassword' ,'Auth\AuthController@forgetpassword')->name('forgetpassword');
// forget password

//reset password
route::get('/reset/{token}' ,'Auth\AuthController@resetpasswordload');
route::post('/reset/{token}' ,'Auth\AuthController@resetpassword')->name('resetPassword');
//reset password


// testimonial start
route::get('testimonial/home' ,[TestimonaialController::class,'home']);
// testimonial end


// middleware start

Route::group(['middleware'=>['web','checkUser']],function()
{
    // reservation
    Route::get('/reservation/step-one', [FrontendreservationController::class, 'stepone'])->name('reservation.step.one');
    Route::post('/reservation/step-one', [FrontendreservationController::class, 'storestepone'])->name('reservation.store.step.one');
    Route::get('/reservation/step-two', [FrontendreservationController::class, 'steptwo'])->name('reservation.step.two');
    Route::post('/reservation/step-two', [FrontendreservationController::class, 'storesteptwo'])->name('reservation.store.step.two');
    Route::get('/reservations/{id}', [FrontendreservationController::class, 'show'])->name('reservations.show')->middleware('auth');
    Route::get('/thankYou', [FrontendReservationController::class, 'thankYou'])->name('thankYou');
    Route::get('/reser', [FrontendreservationController::class, 'index'])->name('reservations.index');
    Route::put('/reservations/{id}/cancel',  [FrontendreservationController::class, 'cancel'])->name('reservations.cancel');
    // Paypal
    Route::post('pay', 'PaymentController@pay')->name('payment');
    Route::get('success', 'PaymentController@success')->name('success');
    Route::get('error', 'PaymentController@error')->name('error');
    // review
    route::get('customer/add-testimonials' ,[TestimonaialController::class , 'add_testimonial']);
    route::post('customer/save-testimonials' ,[TestimonaialController::class , 'save_testimonial']);
     // Contact
    //  Route::get('/create/contact', 'Frontend\ContactController@create')->name('create');
    //  Route::post('/store/contact', 'Frontend\ContactController@store')->name('contact.store');
}); 


Route::group(['middleware'=>['web','checkAdmin']],function()
{
    Route::get('/dashboard','adminController@adminhome')->name('dashboard');
    Route::get('/users','adminController@user')->name('users');
    Route::get('/deleteuser/{id}','adminController@deleteuser')->name('deleteuser');

    Route::get('/cat','Admin\CategoryController@create1')->name('cat');
    
    Route::resource('/categories','Admin\CategoryController');
    Route::resource('/menus','Admin\MenuController');
    Route::resource('/tables','Admin\TableController');
    Route::resource('/reservation','Admin\ReservationController');
    // reports
    Route::get('/analytics', [AnalyticsController::class, 'index']);
    Route::get('/generate-reports', [AnalyticsController::class, 'generateReports'])->name('generate.reports');
    Route::get('/feedback-analytics', [FeedbackAnalyticsController::class, 'showAnalytics'])->name('feedback-analytics.show');
    Route::get('/feedback-analytics/generate', [FeedbackAnalyticsController::class, 'generateReport'])->name('feedback-analytics.generate');
    // contact
    Route::get('/contact','Frontend\ContactController@show')->name('contact.show');
    // Review
    route::get('review/show' ,[TestimonaialController::class,'show']);

}); 

// middleware end

// profile routing
Route::get('profile',function ()  {
    return view('Admin.profile');
});
// stripe payment route
route::get('stripe',[StripeController::class,'stripe']);
route::post('stripe',[StripeController::class,'stripePost'])->name('stripe.post');