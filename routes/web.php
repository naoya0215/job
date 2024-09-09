<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\UserMessageController;


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

Route::get('welcome', function() {
    return view('welcome');
});

Route::middleware('auth:users')->group(function(){
    Route::get('user/home', [HomeController::class, 'index'])->name('user.home');
    Route::post('user/unsubscribe', [HomeController::class, 'unsubscribe'])->name('unsubscribe');
    Route::get('user/usershow/{id}', [HomeController::class, 'usershow'])->name('user.usershow'); //左記のようにルート名を書くと、{{ route('user.user.history') }}で繋がる
    Route::get('user/history', [HomeController::class, 'historycreate'])->name('history'); //左記のようにルート名を書くと、{{ route('user.history') }}で繋がる
    Route::post('historystore', [HomeController::class, 'historystore'])->name('user.historystore');
    Route::get('user/{id}/userinfo', [HomeController::class, 'userinfo'])->name('userinfo')->middleware('auth:users');
    Route::get('user/usercomplete/{id}', [HomeController::class, 'userComplete'])->name('usercomplete')->middleware('auth:users');
});

Route::prefix('usermessage')->
    middleware(['auth:users'])->group(function () {
        Route::get('index', [UserMessageController::class, 'index'])->name('usermessage.index');
        Route::get('show{id}', [UserMessageController::class, 'show'])->name('usermessage.show');
        Route::post('store/{id}', [UserMessageController::class, 'store'])->name('usermessage.store');
});

Route::get('job/index', [JobController::class, 'index'])->name('job.index');
Route::get('job/list', [JobController::class, 'list'])->name('job.list');
Route::get('/job/{id}', [JobController::class, 'show'])->name('job.show');
//応募前の会員登録
Route::get('/job/{id}/info', [JobController::class, 'info'])->name('job.info');
//応募フォーム
Route::get('/job/{id}/apply', [JobController::class, 'apply'])->name('job.apply')->middleware('auth:users');
//応募登録
Route::post('/job/{id}/applystore', [JobController::class, 'applystore'])->name('job.applystore')->middleware('auth:users');
Route::get('/job/{id}/applycomplete', [JobController::class, 'applyComplete'])->name('job.applycomplete')->middleware('auth:users');

require __DIR__.'/auth.php';