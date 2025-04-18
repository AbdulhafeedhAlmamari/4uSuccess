<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConsultantController;
use App\Http\Controllers\dashboard\TransportationController as DashboardTransportationController;
use App\Http\Controllers\dashboard\AdminController as DashboardAdminController;
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
Route::get('/guest', [HomeController::class, 'guest'])->name('guest');
Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('contact.us');
Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('about.us');
Route::get('/join-us', [HomeController::class, 'joinUs'])->name('join.us');

// register routes
Route::post('/student-register', [AuthController::class, 'studentRegister'])->name('student.register');
Route::post('/consultant-register', [AuthController::class, 'consultantRegister'])->name('consultant.register');
Route::post('/financing-register', [AuthController::class, 'financingRegister'])->name('financing.register');
Route::post('/housing-register', [AuthController::class, 'housingRegister'])->name('housing.register');
Route::post('/transportation-register', [AuthController::class, 'transportationRegister'])->name('transportation.register');

// login routes
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

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
// transportations routes
Route::prefix('/dashboard')->group(function () {
    // Admin routes
    Route::get('/admin', [DashboardAdminController::class, 'index'])->name('dashboard.admin');

    // User management
    Route::get('/users', [DashboardAdminController::class, 'getUsers'])->name('admin.users');
    Route::get('/user/edit/{id}', [DashboardAdminController::class, 'editUser'])->name('admin.user.edit');
    Route::get('/user/show/{id}', [DashboardAdminController::class, 'showUser'])->name('admin.user.show');
    Route::get('/user/delete/{id}', [DashboardAdminController::class, 'deleteUser'])->name('admin.user.delete');
    Route::get('/user/update/request/{id}/{is_approved}', [DashboardAdminController::class, 'updateUserRequest'])
        ->name('admin.User.update.request');

    // Students routes
    Route::get('/students', [DashboardStudentController::class, 'index'])->name('dashboard.students.transportations');
    Route::get('/student-orders', [DashboardStudentController::class, 'orders'])->name('dashboard.student_orders');
    Route::get('/student-profile', [DashboardStudentController::class, 'profile'])->name('dashboard.student_profile');
    Route::put('/student/profile/update', [DashboardStudentController::class, 'updateProfile'])->name('student.profile.update');

    // transportations routes
    Route::get('/transportations', [DashboardTransportationController::class, 'index'])->name('dashboard.transportations');
    Route::get('/transportation-orders', [DashboardTransportationController::class, 'orders'])->name('dashboard.transportation_orders');
    Route::get('/transportation-profile', [DashboardTransportationController::class, 'profile'])->name('dashboard.transportation_profile');
    Route::put('/dashboard/transportation/profile/update', [DashboardTransportationController::class, 'updateProfile'])->name('transportation.profile.update');

    // consultants routes
    Route::get('/consultants', [DashboardConsultantController::class, 'index'])->name('dashboard.consultants');
    Route::get('/consultant-orders', [DashboardConsultantController::class, 'orders'])->name('dashboard.consultant_orders');
    Route::get('/consultant-profile', [DashboardConsultantController::class, 'profile'])->name('dashboard.consultant_profile');
    Route::put('/dashboard/consultant/profile/update', [DashboardConsultantController::class, 'updateProfile'])->name('consultant.profile.update');

    // finances routes
    Route::get('/finances', [DashboardFinanceController::class, 'index'])->name('dashboard.finances');
    Route::get('/finance-orders', [DashboardFinanceController::class, 'orders'])->name('dashboard.finance_orders');
    Route::get('/finance-profile', [DashboardFinanceController::class, 'profile'])->name('dashboard.finance_profile');
    Route::put('/dashboard/finance/profile/update', [DashboardFinanceController::class, 'updateProfile'])->name('finance.profile.update');

    // houses routes
    Route::get('/houses', [DashboardHouseController::class, 'index'])->name('dashboard.houses');
    Route::get('/house-orders', [DashboardHouseController::class, 'orders'])->name('dashboard.house_orders');
    Route::get('/house-profile', [DashboardHouseController::class, 'profile'])->name('dashboard.house_profile');
    Route::put('/dashboard/house/profile/update', [DashboardHouseController::class, 'updateProfile'])->name('house.profile.update');
});
