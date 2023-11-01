<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AjaxCatController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ZipController;
use App\Http\Controllers\DropzoneController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\CustomValidationController;
use App\Http\Controllers\Items;
use App\Http\Controllers\LangController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\SocialShareButtonsController;
use App\Http\Controllers\RSSFeedController;
use App\Http\Controllers\ChartJSController;
use Illuminate\Support\Facades\URL;
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

Route::resource('user', CategoryController::class);

// Route::get('/user/{id?}/edit', [CategoryController::class, 'user.edit']);

Route::get('user-export',[CategoryController::class,'export'])->name('user.export');
Route::post('user-import',[CategoryController::class,'import'])->name('user.import');

Route::get('user-export',[AjaxCatController::class,'export'])->name('user.export');
Route::post('user-import',[AjaxCatController::class,'import'])->name('user.import');


Route::view('/welcome', 'welcome');


Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
Route::get('dashboard', [AuthController::class, 'dashboard']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// Route::get('/user_index',[CategoryController::class,'index']);
// Route::get('/user_create',[CategoryController::class,'create']);
// Route::post('/user_store',[CategoryController::class,'store']);
// Route::get('/user_edit/{id}',[CategoryController::class,'edit']);
// Route::put('/user_update/{id}',[CategoryController::class,'update']);
// Route::delete('/user_delete/{id}',[CategoryController::class,'delete']);
Route::post('/fetch_states/{id}',[CategoryController::class,'fetchStates']);
Route::post('/fetch_cities/{id}',[CategoryController::class,'fetchCities']);


Route::get('item', [Items::class, 'index']);
// Route::resource('user', 'CategoryController');

Route::get('ajax-crud-datatable', [AjaxCatController::class, 'index']);
Route::post('store-company', [AjaxCatController::class, 'store']);
Route::post('edit-company', [AjaxCatController::class, 'edit']);
Route::post('delete-company', [AjaxCatController::class, 'destroy']);

//Route::resource('ajaxposts', AjaxCatController::class);

Route::get('email-test', function(){

    $details['email'] = 'nikitabhandare78@gmail.com';

    dispatch(new App\Jobs\SendEmailJob($details));

    dd('done');
    });

Route::get('send/mail', [SendMailController::class, 'sendMailWithAttachment']);

Route::get('sendbasicemail',[MailController:: class, 'basic_email']);

// Route::get('sendhtmlemail','MailController@html_email');
// Route::get('sendattachmentemail','MailController@attachment_email');

Route::get('download-zip', ZipController::class);

Route::controller(DropzoneController::class)->group(function(){

    Route::get('dropzone', 'index');

    Route::post('dropzone/store', 'store')->name('dropzone.store');

});

Route::controller(StripePaymentController::class)->group(function(){

    Route::get('stripe', 'stripe');

    Route::post('stripe', 'stripePost')->name('stripe.post');

});

Route::get('custom-validation', [CustomValidationController::class, 'create']);
Route::post('custom-validation', [CustomValidationController::class, 'store'])->name('custom.validation.post');

Route::get('call-helper', function(){

    $mdY = convertYmdToMdy('2023-07-26');
    var_dump("Converted into 'MDY': " . $mdY);

    $ymd = convertMdyToYmd('07-26-2023');
    var_dump("Converted into 'YMD': " . $ymd);
});

Route::get('lang/home', [LangController::class, 'index']);
Route::get('lang/change', [LangController::class, 'change'])->name('changeLang');

Route::get('generate-pdf', [PDFController::class, 'generatePDF']);

Route::controller(FileController::class)->group(function(){
    Route::get('file-upload', 'index');
    Route::post('file-upload', 'store')->name('file.store');
});

// Route::get("addmore","TagController@addMore");
// Route::post("addmore","TagController@addMorePost");

Route::get('addmore', [TagController::class, 'addMore']);
Route::post('addmore', [TagController::class, 'addMorePost']);

Route::get('google-autocomplete', [GoogleController::class, 'index']);

Route::get('social-media-share', [SocialShareButtonsController::class,'ShareWidget']);

Route::get('feed', [RSSFeedController::class, 'index']);

Route::get('chart', [ChartJSController::class, 'index']);
