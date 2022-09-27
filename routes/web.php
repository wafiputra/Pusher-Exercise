<?php

use App\Events\MyEvent;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\NotifController;
use App\Http\Controllers\PrivateController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin/home', [AdminController::class, 'index'])->name('admin.home');
    Route::post('/notif/public', function ($message) {
        MyEvent::dispatch($message);
    });
});

Route::middleware(['auth', 'user-access:manager'])->group(function () {
    Route::get('/manager/home', [ManagerController::class, 'index'])->name('manager.home');
});

Route::post('send_notif', [NotifController::class, 'send_notif']);
Route::post('send_private', [PrivateController::class, 'send_private']);

// Route::get('/test', function () {
//     event(new App\Events\MyEvent('Someone'));
//     return "Event has been sent!";
// });

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
