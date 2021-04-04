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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\Home\HomeController::class, 'index'])->name('home');

Route::prefix('department/')->name('department.')->group(function () {
    Route::get('index', [App\Http\Controllers\Department\DepartmentController::class, 'index'])->name('index');
    Route::get('create', [App\Http\Controllers\Department\DepartmentController::class, 'create'])->name('create');
});
