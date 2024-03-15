<?php

use App\Http\Controllers\admin\AdminIndexController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\InstructorController;
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


//lesson_instructor routes
Route::middleware('permission:lessons_instructor')->name('instructor.')->prefix('/instructor')->group(function () {
    //Lesson routes
    Route::prefix('/lesson')->group(function () {
        Route::put('/doEdit/{id}', [LessonController::class, 'adminDoEdit'])->name('lesson.doEdit');
    });
});

//Both lesson_instructor and admin_panel access
Route::middleware('permission:lessons_instructor|admin_panel')->name('admin.')->prefix('/admin')->group(function () {
    //Instructor routes (for instructors)
    Route::prefix('/instructors')->name('instructors.')->group(function () {
        Route::get('/', [InstructorController::class, 'index'])->name('index');
        Route::get('/show/{id}', [InstructorController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [InstructorController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [InstructorController::class, 'update'])->name('update');
    });

    Route::prefix('/lesson')->group(function () {
        Route::get('/', [LessonController::class, 'adminIndex'])->name('lesson.index');
        Route::get('/show/{id}', [LessonController::class, 'adminShow'])->name('lesson.show');
        Route::get('/edit/{id}', [LessonController::class, 'adminEdit'])->name('lesson.edit');
    });
});

//Exclusively admin_panel routes
Route::middleware('permission:admin_panel')->name('admin.')->prefix('/admin')->group(function () {

    Route::get('/', [AdminIndexController::class, 'index'])->name('index');

    //Role routes
    Route::resource('/roles', RoleController::class);
    Route::post('/roles/{role}/permissions', [RoleController::class, 'assignPermission'])->name('roles.permission.assign');
    Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'removePermission'])->name('roles.permission.remove');

    //Permission routes
    Route::resource('/permissions', PermissionController::class);

    //User routes
    Route::resource('/users', UserController::class);
    Route::prefix('users')->group(function () {
        Route::post('/{user}/roles', [UserController::class, 'assignRole'])->name('users.roles.assign');
        Route::delete('/{user}/roles/{role}', [UserController::class, 'removeRole'])->name('users.roles.remove');
        Route::post('/filter', [UserController::class, 'filter'])->name('users.filter');
    });

    //Instructor routes
    Route::prefix('/instructors')->name('instructors.')->group(function () {
        Route::delete('/delete/{id}', [InstructorController::class, 'destroy'])->name('destroy');
        Route::get('/create', [InstructorController::class, 'create'])->name('create');
        Route::post('/store', [InstructorController::class, 'store'])->name('store');

    });

    Route::prefix('/lesson')->group(function () {
        Route::get('/create', [LessonController::class, 'adminCreate'])->name('lesson.create');
        Route::post('/doCreate', [LessonController::class, 'adminDoCreate'])->name('lesson.doCreate');
        Route::put('/doEdit/{id}', [LessonController::class, 'adminDoEdit'])->name('lesson.doEdit');
        Route::delete('/delete/{id}', [LessonController::class, 'adminDelete'])->name('lesson.remove');
    });
});



