<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\AdminhomeController;
use App\Http\Controllers\Admin\AdminjobController;
use App\Http\Controllers\Admin\AdminMessageController;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Admin\CompanyController;


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

Route::get('/', function () {
    return view('admin.welcome');
});


Route::middleware('auth:admin')->group(function(){
    Route::get('home', [AdminhomeController::class, 'index'])->name('home');
    Route::post('unsubscribe', [AdminhomeController::class, 'unsubscribe'])->name('unsubscribe');
});

Route::prefix('adminjob')->
    middleware('auth:admin')->group(function(){
        Route::get('index', [AdminjobController::class, 'index'])->name('adminjob.index');
        Route::get('create', [AdminjobController::class, 'create'])->name('adminjob.create');
        Route::post('store', [AdminjobController::class, 'store'])->name('adminjob.store');
        Route::get('edit/{id}', [AdminjobController::class, 'edit'])->name('adminjob.edit');
        Route::put('update/{id}', [AdminjobController::class, 'update'])->name('adminjob.update');
        Route::delete('/adminjob/{id}', [AdminjobController::class, 'destroy'])->name('adminjob.destroy');
});


Route::prefix('message')->
    middleware('auth:admin')->group(function(){
        Route::get('index', [AdminMessageController::class, 'index'])->name('message.index');
        Route::get('show/{id}', [AdminMessageController::class, 'show'])->name('message.show');
        Route::post('store/{id}', [AdminMessageController::class, 'store'])->name('message.store');
});


//Route::prefix('company')->
//    middleware('auth:admin')->group(function(){
//        Route::get('create', [CompanyController::class, 'create'])->name('company.create');
//        Route::post('store', [CompanyController::class, 'store'])->name('company.store');
//});

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store'])
                ->name('register.store');

    Route::post('register/ajax', [RegisteredUserController::class, 'storeajax'])
                ->name('register.store.ajax');

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
