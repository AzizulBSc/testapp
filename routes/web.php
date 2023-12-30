<?php

use App\Http\Controllers\ExcelCSVController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\Backend\Auth\ForgetPasswordController;
use App\Http\Controllers\TestController;
use App\Service\AwesomeServiceInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
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



Route::get('/chat','App\Http\Controllers\ChatController@index')->name('chat');
Route::post('/message', 'App\Http\Controllers\ChatController@message')->name('message');
Route::group(['/prefix' => 'admin'], function () {
    Route::get('/', 'App\Http\Controllers\Backend\DashboardController@index')->name('admin.dashboard');
    Route::resource('roles', 'App\Http\Controllers\Backend\RolesController', ['names' => 'roles']);
    Route::resource('users', 'App\Http\Controllers\Backend\UsersController', ['names' => 'users']);
});

//auth routes
// Auth::routes();
Route::get('/admin/login', 'App\Http\Controllers\Backend\Auth\LoginController@showLoginForm')->name('admin.login');

Route::post('/login/submit', 'App\Http\Controllers\Backend\Auth\LoginController@login')->name('admin.login.submit');

// Logout Routes
Route::get('/logout', 'App\Http\Controllers\Backend\Auth\LoginController@logout')->name('admin.logout');

// Forget Password Routes
Route::get('/password/reset', 'App\Http\Controllers\Backend\Auth\ForgetPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('/password/reset/submit', 'App\Http\Controllers\Backend\Auth\ForgetPasswordController@reset')->name('admin.password.reset');

Route::get('/service', function (AwesomeServiceInterface $awesome_service) {
    $awesome_service->doAwesomeThing();
    // return new Response();
    // dd($this->app());
    // dd('hello World');
    // return view('auth.login');
});
Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/google/login', 'App\Http\Controllers\SocialiteController@redirect')->name('google.login');
Route::get('/callback', 'App\Http\Controllers\SocialiteController@callback');
Route::get('/home', 'App\Http\Controllers\SocialiteController@home')->name('home');

Route::get('lang/{lang}', [HomeController::class, 'switchLang'])->name('lang.switch');

// Route:get(‘google’,function(){

//     Return view(‘googleAuth’);

//     });

Route::get('auth/google', 'App\Http\Controllers\Auth\LoginController@redirectToGoogle');

Route::get('auth/google/callback', 'App\Http\Controllers\Auth\LoginController@handleGoogleCallback');

//Route::get('/send', 'App\Http\Controllers\MailController@index');
Route::get('/mail', 'App\Http\Controllers\MailController@index1');

Route::any('/mailsend', 'App\Http\Controllers\MailController@send');

Route::get('/pdf', 'App\Http\Controllers\PdfController@pdf');

//Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/sms', [App\Http\Controllers\SmsController::class, 'sms']);
Route::any('/sendsms', [App\Http\Controllers\SmsController::class, 'send_sms']);
Route::get('/token', [App\Http\Controllers\PaymentController::class, 'token']);
Route::get('/payment', [App\Http\Controllers\PaymentController::class, 'createPayment']);
Route::post('payment/charge.', [App\Http\Controllers\PaymentController::class, 'charge'])->name('payment.charge');

// Route::get('stripe', [StripeController::class, 'index']);

Route::get('strip/payment', function () {
    return view('strip.payment');
});
Route::post('payment-process', [StripeController::class, 'process']);

Route::get('/test', [TestController::class, 'show']);
Route::get('/pdf', [PdfController::class, 'pdf']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/excel/import', [ExcelCSVController::class, 'index'])->name('excel.import');
Route::post('import-excel-csv-file', [ExcelCSVController::class, 'importExcelCSV']);
Route::get('export-excel-csv-file/{slug}', [ExcelCSVController::class, 'exportExcelCSV']);
