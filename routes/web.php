<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin');
    })->name('dashboard');
    Route::get('/admin/company',[CompanyController::class,'index'])->name('company.index');
    Route::get('/admin/company/add',[CompanyController::class,'create']);
    Route::post('/admin/company/add',[CompanyController::class,'store']);
    Route::put('/admin/company/add',[CompanyController::class,'store']);
    Route::get('/admin/company/edit/{id}',[CompanyController::class,'edit']);
    Route::get('/admin/company/delete/{id}',[CompanyController::class,'delete']);


    Route::get('/admin/employee',[EmployeeController::class,'index'])->name('employee.index');
    Route::get('/admin/employee/add',[EmployeeController::class,'create']);
    Route::post('/admin/employee/add',[EmployeeController::class,'store']);
    Route::get('/admin/employee/edit/{id}',[EmployeeController::class,'edit']);
    Route::get('/admin/employee/delete/{id}',[EmployeeController::class,'delete']);

});
