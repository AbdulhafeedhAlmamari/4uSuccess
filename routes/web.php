<?php

use App\Http\Controllers\ConsultantController;
use App\Http\Controllers\dashboard\CompanyController as DashboardCompanyController;
use App\Http\Controllers\dashboard\ConsultantController as DashboardConsultantController;
use App\Http\Controllers\dashboard\FinanceController as DashboardFinanceController;
use App\Http\Controllers\dashboard\HouseController as DashboardHouseController;
use App\Http\Controllers\dashboard\StudentController as DashboardStudentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TransportController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('contact.us');
Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('about.us');

// consultants routes
Route::get('/consultants', [ConsultantController::class, 'index'])->name('home.consultants');
Route::get('/consultant-show', [ConsultantController::class, 'show'])->name('home.consultants.show');
Route::get('/consultation-request', [ConsultantController::class, 'consultationRequest'])->name('home.consultants.consultation_request');
Route::get('/consultation-requests', [ConsultantController::class, 'consultationRequests'])->name('home.consultants.consultation_requests');

// houses routes
Route::get('/houses', [HouseController::class, 'index'])->name('home.houses');
Route::get('/house-show', [HouseController::class, 'show'])->name('home.houses.show');

// transports routes
Route::get('/transports', [TransportController::class, 'index'])->name('home.transports');
Route::get('/transport-show', [TransportController::class, 'show'])->name('home.transport.show');
Route::get('/transport-search', [TransportController::class, 'search'])->name('home.transport.search');
Route::get('/transport-search-result', [TransportController::class, 'searchResult'])->name('home.transport.search_result');

// payment routes
Route::get('/payment', [PaymentController::class, 'index'])->name('home.payment');



// dashboards routes
// companies routes
Route::prefix('/dashboard')->group(function () {
    // Students routes
    Route::get('/students', [DashboardStudentController::class, 'index'])->name('dashboard.students.companies');
    Route::get('/student-orders', [DashboardStudentController::class, 'orders'])->name('dashboard.student_orders');
    Route::get('/student-profile', [DashboardStudentController::class, 'profile'])->name('dashboard.student_profile');

    // companies routes
    Route::get('/companies', [DashboardCompanyController::class, 'index'])->name('dashboard.companies.companies');
    Route::get('/company-orders', [DashboardCompanyController::class, 'orders'])->name('dashboard.company_orders');
    Route::get('/company-profile', [DashboardCompanyController::class, 'profile'])->name('dashboard.company_profile');

    // consultants routes
    Route::get('/consultants', [DashboardConsultantController::class, 'index'])->name('dashboard.consultants');
    Route::get('/consultant-orders', [DashboardConsultantController::class, 'orders'])->name('dashboard.consultant_orders');
    Route::get('/consultant-profile', [DashboardConsultantController::class, 'profile'])->name('dashboard.consultant_profile');

    // finances routes
    Route::get('/finances', [DashboardFinanceController::class, 'index'])->name('dashboard.finances');
    Route::get('/finance-orders', [DashboardFinanceController::class, 'orders'])->name('dashboard.finance_orders');
    Route::get('/finance-profile', [DashboardFinanceController::class, 'profile'])->name('dashboard.finance_profile');

    // houses routes
    Route::get('/houses', [DashboardHouseController::class, 'index'])->name('dashboard.houses');
    Route::get('/house-orders', [DashboardHouseController::class, 'orders'])->name('dashboard.house_orders');
    Route::get('/house-profile', [DashboardHouseController::class, 'profile'])->name('dashboard.house_profile');
});
