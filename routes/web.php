<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['permission:lessons_can_crud']], function () {
    Route::get('/test', [App\Http\Controllers\TestController::class, 'index'])->name('test');
});
Route::middleware('permission:admin_panel') -> name('admin.')
    ->prefix('admin')-> group(function () {
        Route::get('/',[\App\Http\Controllers\admin\IndexController::class, 'index'])->name('index');
        Route::resource('/roles',\App\Http\Controllers\admin\RoleController::class);
        Route::resource('/permissions',\App\Http\Controllers\admin\PermissionController::class);
    });

