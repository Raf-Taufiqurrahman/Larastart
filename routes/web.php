<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;

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


Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' =>['auth']], function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::resource('/permission', PermissionController::class)->except(['create', 'edit', 'show']);
    Route::resource('/role', RoleController::class)->except(['create', 'edit', 'show']);
    Route::resource('/user', UserController::class)->except(['create', 'edit', 'show']);
});
