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

// Route group of user
Route::prefix('user/')->name('user.')->group(function () {

    // Display user index page
    Route::get('index', [App\Http\Controllers\User\UserController::class, 'index'])->name('index');

    // Create new user
    Route::get('create', [App\Http\Controllers\User\UserController::class, 'create'])->name('create');

    // Create a new position
    Route::post('store', [App\Http\Controllers\User\UserController::class, 'store'])->name('store');

    // Edit a user index page
    Route::get('edit/{id}', [App\Http\Controllers\User\UserController::class, 'edit'])->name('edit');

    // Update user index page
    Route::post('update', [App\Http\Controllers\User\UserController::class, 'update'])->name('update');

    // Delete a user
    Route::get('destroy', [App\Http\Controllers\User\UserController::class, 'destroy'])->name('destroy');// Delete a user

    // Upload user profile photo
    Route::get('upload/photo', [App\Http\Controllers\User\UserController::class, 'uploadPhoto'])->name('upload.photo'); // Upload user profile photo

    // Update profile photo
    Route::post('update/profile/photo', [App\Http\Controllers\User\UserController::class, 'updateProfilePhoto'])->name('update.profile.photo');

    // Assign Role to a user
    Route::get('assign/role/{id}', [App\Http\Controllers\User\UserController::class, 'assignRole'])->name('assign.role');

    // Update assign Role to a user
    Route::post('assign/role/update', [App\Http\Controllers\User\UserController::class, 'assignRoleUpdate'])->name('assign.role.update');
});

// Route group of Permission
Route::prefix('permission/')->name('permission.')->group(function () {

    // Display permission index page
    Route::get('index', [App\Http\Controllers\Permission\PermissionController::class, 'index'])->name('index');

    // Display permission create modal
    Route::get('create', [App\Http\Controllers\Permission\PermissionController::class, 'create'])->name('create');

    // Create a new permission
    Route::post('store', [App\Http\Controllers\Permission\PermissionController::class, 'store'])->name('store');

    // Edit a permission
    Route::get('edit/{id}', [App\Http\Controllers\Permission\PermissionController::class, 'edit'])->name('edit');

    // Update a permission
    Route::post('update', [App\Http\Controllers\Permission\PermissionController::class, 'update'])->name('update');

    // Delete a permission
    Route::get('destroy', [App\Http\Controllers\Permission\PermissionController::class, 'destroy'])->name('destroy');
});

// Route group of Role
Route::prefix('role/')->name('role.')->group(function () {

    // Display role index page
    Route::get('index', [App\Http\Controllers\Role\RoleController::class, 'index'])->name('index');

    // Display role create modal
    Route::get('create', [App\Http\Controllers\Role\RoleController::class, 'create'])->name('create');

    // Create a new role
    Route::post('store', [App\Http\Controllers\Role\RoleController::class, 'store'])->name('store');

    // Create a new role
    Route::get('assign/permission/{id}', [App\Http\Controllers\Role\RoleController::class, 'assignPermission'])->name('assign.permission');

    // Create a new role
    Route::post('assign/permission/update', [App\Http\Controllers\Role\RoleController::class, 'assignPermissionUpdate'])->name('assign.permission.update');

    // Edit a role
    Route::get('edit/{id}', [App\Http\Controllers\Role\RoleController::class, 'edit'])->name('edit');

    // Update a role
    Route::post('update', [App\Http\Controllers\Role\RoleController::class, 'update'])->name('update');

    // Delete a role
    Route::get('destroy', [App\Http\Controllers\Role\RoleController::class, 'destroy'])->name('destroy');
});
