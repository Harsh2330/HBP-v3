<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MedicalVisitController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('medical_visit', MedicalVisitController::class);
    Route::get('medical_visit/{id}/edit', [MedicalVisitController::class, 'edit'])->name('medical_visit.edit');
    Route::patch('medical_visit/{id}', [MedicalVisitController::class, 'update'])->name('medical_visit.update');
    Route::patch('/medical_visit/{id}/approve', [MedicalVisitController::class, 'approve'])->name('medical_visit.approve');
    Route::patch('/medical_visit/{id}/update_status', [MedicalVisitController::class, 'updateStatus'])->name('medical_visit.update_status');
    Route::delete('/medical_visit/{id}', [MedicalVisitController::class, 'destroy'])->name('medical_visit.destroy');
});