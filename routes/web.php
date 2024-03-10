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

Route::middleware('permission:admin_panel') -> name('admin.')
    ->prefix('admin')-> group(function () {
        Route::get('/',[AdminIndexController::class, 'index'])->name('index');

        //Role routes
        Route::resource('/roles',RoleController::class);
        Route::post('/roles/{role}/permissions',[RoleController::class, 'assignPermission'])->name('roles.permission.assign');
        Route::delete('/roles/{role}/permissions/{permission}',[RoleController::class, 'removePermission'])->name('roles.permission.remove');

        //Permission routes
        Route::resource('/permissions',PermissionController::class);

        //User routes
        Route::resource('users',UserController::class);
        Route::post('/users/{user}/roles',[UserController::class,'assignRole'])->name('users.roles.assign');
        Route::delete('/users/{user}/roles/{role}',[UserController::class,'removeRole'])->name('users.roles.remove');

        Route::prefix('/lesson')->group(function(){
            Route::get('/', [LessonController::class, 'adminIndex'])->name('lesson.index');
            Route::get('show/{id}', [LessonController::class, 'adminShow'])->name('lesson.show');
            Route::get('create', [LessonController::class, 'adminCreate'])->name('lesson.create');
            Route::post('doCreate', [LessonController::class, 'adminDoCreate'])->name('lesson.doCreate');
        });
});
