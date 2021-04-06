<?php

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

// Display welcome page
Route::get('/', function () {
    return view('welcome');
});

// Laravel ui Authentication
Auth::routes();

// Display home page
Route::get('/home', [App\Http\Controllers\Home\HomeController::class, 'index'])->name('home');

//Route group of department
Route::prefix('department/')->name('department.')->group(function () {

    // Display department index page
    Route::get('index', [App\Http\Controllers\Department\DepartmentController::class, 'index'])->name('index');

    // Display department create modal
    Route::get('create', [App\Http\Controllers\Department\DepartmentController::class, 'create'])->name('create');

    // Create a new department
    Route::post('store', [App\Http\Controllers\Department\DepartmentController::class, 'store'])->name('store');

    // Edit a department
    Route::get('edit/{id}', [App\Http\Controllers\Department\DepartmentController::class, 'edit'])->name('edit');

    // Update a department
    Route::post('update', [App\Http\Controllers\Department\DepartmentController::class, 'update'])->name('update');

    // Delete a department
    Route::get('destroy', [App\Http\Controllers\Department\DepartmentController::class, 'destroy'])->name('destroy');
});

// Route group of position
Route::prefix('position/')->name('position.')->group(function () {

    // Display position index page
    Route::get('index', [App\Http\Controllers\Position\PositionController::class, 'index'])->name('index');

    // Display position create modal
    Route::get('create', [App\Http\Controllers\Position\PositionController::class, 'create'])->name('create');

    // Create a new position
    Route::post('store', [App\Http\Controllers\Position\PositionController::class, 'store'])->name('store');

    // Edit a position
    Route::get('edit/{id}', [App\Http\Controllers\Position\PositionController::class, 'edit'])->name('edit');

    // Update a position
    Route::post('update', [App\Http\Controllers\Position\PositionController::class, 'update'])->name('update');

    // Delete a position
    Route::get('destroy', [App\Http\Controllers\Position\PositionController::class, 'destroy'])->name('destroy');
});
