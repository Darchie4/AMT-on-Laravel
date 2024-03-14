<?php

use App\Http\Controllers\admin\AdminIndexController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\UserController;
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

Route::prefix('/lesson')->group(function () {
    Route::get('/', [LessonController::class, 'index'])->name('lesson.index');
    Route::get('/show/{id}', [LessonController::class, 'show'])->name('lesson.show');
    Route::get('/signup/{id}', [LessonController::class, 'signup'])->name('lesson.signup');
});

Route::middleware('permission:admin_panel') -> name('admin.')
    ->prefix('admin')-> group(function () {
        Route::get('/',[AdminIndexController::class, 'index'])->name('index');

        //Role routes
        Route::resource('/roles', RoleController::class);
        Route::post('/roles/{role}/permissions', [RoleController::class, 'assignPermission'])->name('roles.permission.assign');
        Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'removePermission'])->name('roles.permission.remove');

        //Permission routes
        Route::resource('/permissions', PermissionController::class);

        //User routes
        Route::resource('/users',UserController::class);
        Route::prefix('users')->group(function(){
            Route::post('/{user}/roles',[UserController::class,'assignRole'])->name('users.roles.assign');
            Route::delete('/{user}/roles/{role}',[UserController::class,'removeRole'])->name('users.roles.remove');
            Route::post('/filter',[UserController::class,'filter'])->name('users.filter');
        });

        Route::prefix('/lesson')->group(function () {
            Route::get('/', [LessonController::class, 'adminIndex'])->name('lesson.index');
            Route::get('/show/{id}', [LessonController::class, 'adminShow'])->name('lesson.show');
            Route::get('/create', [LessonController::class, 'adminCreate'])->name('lesson.create');
            Route::post('/doCreate', [LessonController::class, 'adminDoCreate'])->name('lesson.doCreate');
            Route::get('/edit/{id}', [LessonController::class, 'adminEdit'])->name('lesson.edit');
            Route::put('/doEdit/{id}', [LessonController::class, 'adminDoEdit'])->name('lesson.doEdit');
            Route::delete('/delete/{id}', [LessonController::class, 'adminDelete'])->name('lesson.remove');
        });
    });

Route::middleware('permission:lessons_instructor')->name('instructor.')
    ->prefix('/instructor')->group(function () {
    Route::prefix('/lesson')->group(function () {
        Route::put('/doEdit/{id}', [LessonController::class, 'adminDoEdit'])->name('lesson.doEdit');
    });
});
