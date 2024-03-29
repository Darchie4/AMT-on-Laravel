<?php

use App\Http\Controllers\admin\AdminIndexController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\LocationController;
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

//PUBLIC ROUTES
Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/locations')->name('locations.public.')->group(function () {
    Route::get('/', [LocationController::class, 'publicIndex'])->name('index');
    Route::get('/show/{id}', [LocationController::class, 'publicShow'])->name('show');
});

Route::prefix('/instructors')->name('instructors.public.')->group(function () {
    Route::get('/', [InstructorController::class, 'publicIndex'])->name('index');
    Route::get('/show/{id}', [InstructorController::class, 'publicShow'])->name('show');
});
Auth::routes();


//PERMISSION BASED ROUTES

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//lesson_instructor routes
Route::middleware('permission:lessons_instructor')->name('instructor.')->prefix('/instructor')->group(function () {
    //Lesson routes
    Route::prefix('/lesson')->group(function () {
        Route::put('/doEdit/{id}', [LessonController::class, 'adminDoEdit'])->name('lesson.doEdit');
    });
});

//Admin routes
Route::prefix('/admin')->name('admin.')->group(function () {

    Route::get('/', [AdminIndexController::class, 'index'])->name('index')->middleware('permission:admin_dashboard');

    //Role routes
    Route::middleware('permission:routes_crud')->group(function () {
        Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'removePermission'])->name('roles.permission.remove');
        Route::post('/roles/{role}/permissions', [RoleController::class, 'assignPermission'])->name('roles.permission.assign');
        Route::resource('/roles', RoleController::class);
    });

    //Permission routes
    Route::resource('/permissions', PermissionController::class)->middleware('permission:permissions_crud');

    //User routes
    Route::middleware('permission:users_crud')->group(function () {
        Route::resource('/users', UserController::class);
        Route::prefix('users')->group(function () {
            Route::post('/{user}/roles', [UserController::class, 'assignRole'])->name('users.roles.assign');
            Route::delete('/{user}/roles/{role}', [UserController::class, 'removeRole'])->name('users.roles.remove');
            Route::post('/filter', [UserController::class, 'filter'])->name('users.filter');
        });
    });


    //Instructor routes
    Route::middleware('permission:instructors_crud')->group(function () {
        Route::prefix('/instructors')->name('instructors.')->group(function () {
            Route::delete('/delete/{id}', [InstructorController::class, 'destroy'])->name('destroy');
            Route::get('/create', [InstructorController::class, 'create'])->name('create');
            Route::post('/store', [InstructorController::class, 'store'])->name('store');
        });
    });
    //Instructor routes (for instructors)
    Route::middleware('permission:instructors_crud|instructors_own')->prefix('/instructors')
        ->name('instructors.')
        ->group(function () {
            Route::get('/', [InstructorController::class, 'index'])->name('index');
            Route::get('/show/{id}', [InstructorController::class, 'show'])->name('show');
            Route::get('/edit/{id}', [InstructorController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [InstructorController::class, 'update'])->name('update');
        });


    Route::middleware('permission:lessons_crud')->prefix('/lesson')
        ->group(function () {
            Route::get('/create', [LessonController::class, 'adminCreate'])->name('lesson.create');
            Route::post('/doCreate', [LessonController::class, 'adminDoCreate'])->name('lesson.doCreate');
            Route::put('/doEdit/{id}', [LessonController::class, 'adminDoEdit'])->name('lesson.doEdit');
            Route::delete('/delete/{id}', [LessonController::class, 'adminDelete'])->name('lesson.remove');
        });

    Route::middleware('permission:lessons_own|lessons_crud')->prefix('/lesson')->group(function () {
        Route::get('/', [LessonController::class, 'adminIndex'])->name('lesson.index');
        Route::get('/show/{id}', [LessonController::class, 'adminShow'])->name('lesson.show');
        Route::get('/edit/{id}', [LessonController::class, 'adminEdit'])->name('lesson.edit');
    });


    Route::middleware('permission:locations_crud')->group(function () {
        Route::prefix('/locations')->name('locations.')->group(function () {
            Route::get('/',[LocationController::class,'index'])->name('index');
            Route::delete('/delete/{id}', [LocationController::class, 'destroy'])->name('destroy');
            Route::get('/create', [LocationController::class, 'create'])->name('create');
            Route::post('/store', [LocationController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [LocationController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [LocationController::class, 'update'])->name('update');
        });
    });

});





