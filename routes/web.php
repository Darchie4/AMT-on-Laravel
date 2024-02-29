<?php

use App\Http\Controllers\LessonController;
use Illuminate\Support\Facades\Auth;
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

Route::prefix('/admin')->group(function () {
    Route::prefix('/lesson')->group(function(){
        Route::get('index', [LessonController::class, 'adminIndex'])->name('admin.lesson.index');
        Route::get('create', [LessonController::class, 'adminCreate'])->name('admin.lesson.create');
        Route::post('doCreate', [LessonController::class, 'adminDoCreate'])->name('admin.lesson.doCreate');
    });
});
