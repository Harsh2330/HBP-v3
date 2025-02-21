<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{HomeController, RoleController, UserController, ProductController, MedicalVisitController, RequestForVisitController, AdminDashboardController, UserDashboardController, DoctorDashboardController, NurseDashboardController};
use App\Http\Controllers\Admin\PatientController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\DoctorReportController;
use App\Http\Controllers\UserReportController;

Route::view('/', 'Homepage.welcome')->name('welcome');
Route::view('/about-us', 'Homepage.about')->name('about-us');
Route::view('/services', 'Homepage.services')->name('services');

// Services Routes
foreach (range(1, 5) as $num) {
    Route::view("/services/service{$num}", "Services.Service{$num}")->name("services.service{$num}");
}

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function() {
    Route::resources([
        'roles' => RoleController::class,
        'users' => UserController::class,
        'medical_visit' => MedicalVisitController::class,
        'request_for_visit' => RequestForVisitController::class,
    ]);
    
    Route::patch('/medical_visit/{id}/approve', [MedicalVisitController::class, 'approve'])->name('medical_visit.approve');
    Route::patch('/medical_visit/{id}/reject', [MedicalVisitController::class, 'reject'])->name('medical_visit.reject');
    Route::patch('/medical_visit/{id}/update_status', [MedicalVisitController::class, 'updateStatus'])->name('medical_visit.update_status');
    Route::patch('/medical_visit/{id}/reschedule', [MedicalVisitController::class, 'reschedule'])->name('medical_visit.reschedule');
    Route::get('/calendar', [MedicalVisitController::class, 'calendar'])->name('calendar');
    Route::get('/medical-visit/details/{id}', [MedicalVisitController::class, 'getVisitDetails'])->name('medical_visit.details');

    // Dashboard Routes
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/doctor/dashboard', [DoctorDashboardController::class, 'index'])->name('doctor.dashboard');
    Route::get('/nurse/dashboard', [NurseDashboardController::class, 'index'])->name('nurse.dashboard');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function() {
    Route::resource('patient', PatientController::class);
    Route::post('patient/{id}/approve', [PatientController::class, 'approve'])->name('patient.approve');
    Route::put('patient/{id}/storePatientData', [PatientController::class, 'storePatientData'])->name('patient.storePatientData');
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/report', [AdminReportController::class, 'generateReport'])->name('report');
});

// Patient Routes
Route::prefix('patient')->name('patient.')->middleware(['auth'])->group(function() {
    Route::get('dashboard', [HomeController::class, 'patientIndex'])->name('dashboard');
    Route::get('profile', [PatientController::class, 'profile'])->name('profile');
    Route::post('profile', [PatientController::class, 'updateProfile'])->name('profile.update');
});

// API Route
Route::get('/api/users-with-role/{role}', [UserController::class, 'getUsersWithRole']);

// Report Routes
Route::get('/doctor/report/{doctorId}', [DoctorReportController::class, 'generateReport'])->name('doctor.report');
Route::get('/user/report', [UserReportController::class, 'generateReport'])->name('reports.user');
