<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminRoleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UomController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\RequestProductController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ReportsController;

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
    // return view('welcome');
    return redirect()->route('login');
});

Route::get('admin/login', [AuthController::class, 'login'])->name('login');
Route::post('admin/login', [AuthController::class,'loginDashboard'])->name('login.post');

Route::group(['prefix' => 'admin','middleware' => ['auth','prevent-back-history'],'as' =>'backend.'],function() {
    Route::get('dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('lock', [AuthController::class, 'lock'])->name('lock');
    Route::post('lock', [AuthController::class, 'unlock'])->name('unlock');


     //Role Settings
     Route::get('/roles', [RolePermissionController::class, 'index'])->name('role.list');
     Route::get('/create-role', [RolePermissionController::class, 'createRole'])->name('create.role');
     Route::post('/store-role', [RolePermissionController::class, 'storeRole'])->name('store.role');
     Route::get('/edit-role/{id}', [RolePermissionController::class, 'editRole'])->name('edit.role');
     Route::post('/update-role/{id}', [RolePermissionController::class, 'updateRole'])->name('update.role');
     Route::get('/delete-role/{id}', [RolePermissionController::class, 'deleteRole'])->name('delete.role');

     Route::get('/list', [AdminRoleController::class, 'adminList'])->name('user.list');
     Route::get('/create', [AdminRoleController::class, 'createAdmin'])->name('create.admin');
     Route::post('/store', [AdminRoleController::class, 'storeAdmin'])->name('store.admin');
     Route::get('/edit/{id}', [AdminRoleController::class, 'editAdmin'])->name('edit.admin');
     Route::post('/update', [AdminRoleController::class, 'updateAdmin'])->name('update.admin');
     Route::get('/delete/{id}', [AdminRoleController::class, 'deleteAdmin'])->name('delete.admin');
});
