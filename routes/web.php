<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\PatientController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MedicalVisitController;
use App\Http\Controllers\RequestForVisitController;
use App\Http\Controllers\AdminDashboardController; // Add this import

Route::get('/', function () {
    return view('Homepage.welcome');
});
Route::get('/about-us', function () {
    return view('Homepage.about');
})->name('about-us');
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
    Route::patch('/medical_visit/{id}/reject', [MedicalVisitController::class, 'reject'])->name('medical_visit.reject');
    Route::patch('/medical_visit/{id}/update_status', [MedicalVisitController::class, 'updateStatus'])->name('medical_visit.update_status');
    Route::delete('/medical_visit/{id}', [MedicalVisitController::class, 'destroy'])->name('medical_visit.destroy');
});

// Admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function() {
    Route::resource('patient', PatientController::class);
    Route::post('patient/{user}/approve', [PatientController::class, 'approve'])->name('patient.approve');
    Route::post('patient', [PatientController::class, 'store'])->name('patient.store');
    Route::put('patient/{id}/storePatientData', [PatientController::class, 'storePatientData'])->name('patient.storePatientData');
    Route::get('patient-list', [PatientController::class, 'list'])->name('patient.list');
    Route::delete('patient/{id}', [PatientController::class, 'destroy'])->name('patient.destroy'); // Add this line
Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard'); // Ensure this line is correct
});

Route::prefix('admin')->group(function () {
    Route::get('patient/list', [PatientController::class, 'list'])->name('admin.patient.list');
    Route::get('patient/create', [PatientController::class, 'create'])->name('admin.patient.create');
    Route::post('patient/store', [PatientController::class, 'store'])->name('admin.patient.store');
    Route::get('patient/{id}/show', [PatientController::class, 'show'])->name('admin.patient.show');
    Route::get('patient/{id}/edit', [PatientController::class, 'edit'])->name('admin.patient.edit');
    Route::put('patient/{id}', [PatientController::class, 'update'])->name('admin.patient.update');
    Route::delete('patient/{id}', [PatientController::class, 'destroy'])->name('admin.patient.destroy');
    Route::post('patient/{id}/approve', [PatientController::class, 'approve'])->name('admin.patient.approve');
    Route::get('patient', [PatientController::class, 'index'])->name('admin.patient.index');
});

// Add patient panel routes
Route::prefix('patient')->name('patient.')->middleware(['auth'])->group(function() {
    Route::get('dashboard', [HomeController::class, 'patientIndex'])->name('dashboard');
    Route::get('profile', [PatientController::class, 'profile'])->name('profile');
    Route::post('profile', [PatientController::class, 'updateProfile'])->name('profile.update');
});

// API route to fetch users with a specified role
Route::get('/api/users-with-role/{role}', [UserController::class, 'getUsersWithRole']);

// Add the route for request_for_visit
Route::get('/request_for_visit', [RequestForVisitController::class, 'index'])->name('request_for_visit');
Route::get('/request-for-visit/create', [RequestForVisitController::class, 'create'])->name('request_for_visit.create');
Route::post('/request-for-visit/store', [RequestForVisitController::class, 'store'])->name('request_for_visit.store');
Route::post('/request-for-visit/{id}/approve', [RequestForVisitController::class, 'approve'])->name('approve.visit');

Route::resource('request_for_visit', RequestForVisitController::class);