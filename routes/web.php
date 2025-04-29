<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConsultantController;
use App\Http\Controllers\ConsultationRequestController;
use App\Http\Controllers\dashboard\TransportationController as DashboardTransportationController;
use App\Http\Controllers\dashboard\AdminController as DashboardAdminController;
use App\Http\Controllers\dashboard\ContactController as DashboardContactController;
use App\Http\Controllers\dashboard\ConsultantController as DashboardConsultantController;
use App\Http\Controllers\dashboard\FinanceController as DashboardFinanceController;
use App\Http\Controllers\dashboard\HouseController as DashboardHouseController;
use App\Http\Controllers\dashboard\StudentController as DashboardStudentController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\HousingController;
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
Route::get('/consultant-show/{id}', [ConsultantController::class, 'show'])->name('home.consultants.show');
// Route::get('/consultation-request', [ConsultantController::class, 'consultationRequest'])->name('home.consultants.consultation_request');
Route::get('/consultation-requests', [ConsultantController::class, 'consultationRequests'])->name('home.consultants.consultation_requests');

// finance routes
Route::get('/finances', [FinanceController::class, 'index'])->name('home.finances');
Route::get('/finance-show/{id}', [FinanceController::class, 'show'])->name('home.finances.show');
Route::get('/finance/order/create/{id}', [FinanceController::class, 'createOrder'])->name('home.finances.order.create');
// store finance
Route::post('/finance/store', [FinanceController::class, 'store'])->name('home.finances.store');

// houses routes
Route::get('/houses', [HouseController::class, 'index'])->name('home.houses');
Route::get('/house-show/{id}', [HouseController::class, 'show'])->name('houses.show');
Route::post('/house-reservation-store', [HouseController::class, 'reservationStore'])->name('houses.reservation.store');

// transports routes
Route::get('/transports', [TransportController::class, 'index'])->name('home.transports');
Route::get('/transport-show', [TransportController::class, 'show'])->name('home.transport.show');
Route::get('/transport-search', [TransportController::class, 'search'])->name('home.transport.search');
// Route::get('/transport-search-result', [TransportController::class, 'searchResult'])->name('home.transport.search_result');
Route::post('/transport/store', [TransportController::class, 'store'])->name('home.transport.store');
Route::post('/transport/search/trip', [TransportController::class, 'searchForTrip'])->name('home.transport.search.for_trip');



// payment routes
Route::get('/payment', [PaymentController::class, 'index'])->name('home.payment');



// dashboards routes
// transportations routes
Route::prefix('/dashboard')->group(function () {
    // Admin routes
    Route::get('/consultants', [DashboardConsultantController::class, 'index'])->name('dashboard.consultants');






    Route::get('/admin', [DashboardAdminController::class, 'index'])->name('dashboard.admin');
    // Route::get('/admin/contact', [DashboardAdminController::class, 'contact'])->name('admin.contact');
    Route::get('/admin/contacts', [DashboardContactController::class, 'index'])->name('admin.contacts');
    Route::post('/admin/contacts/{id}/reply', [DashboardContactController::class, 'reply'])->name('contacts.reply');
    Route::delete('/admin/contacts/{id}', [DashboardContactController::class, 'destroy'])->name('contacts.destroy');
    // Route::post('/admin/contacts/filter', [DashboardContactController::class, 'filter'])->name('contacts.filter');
    Route::post('/contact', [DashboardContactController::class, 'store'])->name('contact.store');

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
    // Route::get('/student/consultations/orders', [DashboardStudentController::class, 'index'])->name('student.consultations.orders');

    // transportations routes
    Route::get('/transportations', [DashboardTransportationController::class, 'index'])->name('dashboard.transportations');
    Route::get('/all-transportations', [DashboardTransportationController::class, 'getAllTransportations'])->name('dashboard.all_transportations');
    Route::post('/transportations/store', [DashboardTransportationController::class, 'store'])->name('dashboard.transportations.store');
    Route::put('/transportations/{id}', [DashboardTransportationController::class, 'update'])->name('dashboard.transportations.update');
    Route::delete('/transportations/{id}', [DashboardTransportationController::class, 'destroy'])->name('dashboard.transportations.destroy');
    Route::get('/transportation-orders/{status}', [DashboardTransportationController::class, 'orders'])->name('dashboard.transportation_orders');
    Route::post('/houses/reservation/{reservation}/status', [DashboardHouseController::class, 'updateStatus'])->name('dashboard.houses.reservation.status');
    Route::get('/transportation-profile', [DashboardTransportationController::class, 'profile'])->name('dashboard.transportation_profile');
    Route::put('/dashboard/transportation/profile/update', [DashboardTransportationController::class, 'updateProfile'])->name('transportation.profile.update');

    // consultants routes

    // consultants routes
    //  route('dashboard.consultant_orders', ['status' => 'current'])
    // Route::get('/consultant-orders/{status}', [DashboardConsultantController::class, 'orders'])->name('dashboard.consultant_orders');

    Route::get('/consultants', [DashboardConsultantController::class, 'index'])->name('dashboard.consultants');
    // Route::get('/consultant-orders/{status}', [DashboardConsultantController::class, 'orders'])->name('dashboard.consultant_orders');
    Route::get('/consultant-profile', [DashboardConsultantController::class, 'profile'])->name('dashboard.consultant_profile');
    Route::put('/dashboard/consultant/profile/update', [DashboardConsultantController::class, 'updateProfile'])->name('consultant.profile.update');

    // Consultation request routes dashboard
    Route::get('/consultant-orders/{status}', [ConsultationRequestController::class, 'index'])->name('dashboard.consultant_orders');
    Route::get('/consultation-request/accept/{id}', [ConsultationRequestController::class, 'accept'])->name('consultation.request.accept');
    // Route::get('/consultation-request/reject/{id}', [ConsultationRequestController::class, 'reject'])->name('consultation.request.reject');
    Route::get('/consultation-request/complete/{id}', [ConsultationRequestController::class, 'complete'])->name('consultation.request.complete');

    Route::post('/consultation-request/{id}/accept', [ConsultationRequestController::class, 'accept'])->name('consultation.request.accept');
    Route::post('/consultation-request/{id}/reject', [ConsultationRequestController::class, 'reject'])->name('consultation.request.reject');



    // Consultation request routes
    Route::get('/consultation-request', [ConsultationRequestController::class, 'create'])->name('home.consultants.consultation_request');
    Route::post('/consultation-request', [ConsultationRequestController::class, 'store'])->name('consultation.request.store');
    Route::get('/filter-consultants', [ConsultationRequestController::class, 'filterConsultants'])->name('filter.consultants');

    // finances routes
    Route::get('/finances', [DashboardFinanceController::class, 'index'])->name('dashboard.finances');
    Route::get('/finance-orders/{status}', [DashboardFinanceController::class, 'orders'])->name('dashboard.finance_orders');
    Route::get('/finance-profile', [DashboardFinanceController::class, 'profile'])->name('dashboard.finance_profile');
    Route::put('/dashboard/finance/profile/update', [DashboardFinanceController::class, 'updateProfile'])->name('finance.profile.update');
    Route::post('/finance-orders/reject/{id}', [DashboardFinanceController::class, 'reject'])->name('consultation.request.reject');
    Route::post('/dashboard/finance-orders/update-status', [DashboardFinanceController::class, 'updateStatus'])->name('dashboard.finance_orders.update_status');
    Route::get('/finances/details', [DashboardFinanceController::class, 'showDetails'])->name('dashboard.finances.details');


    // houses routes
    Route::get('/houses', [DashboardHouseController::class, 'index'])->name('dashboard.houses');
    Route::get('/all-houses', [DashboardHouseController::class, 'getAllHouses'])->name('dashboard.all_houses');
    Route::post('/houses-request', [DashboardHouseController::class, 'store'])->name('dashboard.houses.request');
    Route::put('/houses/{id}', [DashboardHouseController::class, 'update'])->name('dashboard.houses.update');
    Route::delete('/houses/{id}', [DashboardHouseController::class, 'destroy'])->name('dashboard.houses.destroy');
    Route::get('/house-orders/{status}', [DashboardHouseController::class, 'orders'])->name('dashboard.house_orders');
    Route::get('/house-profile', [DashboardHouseController::class, 'profile'])->name('dashboard.house_profile');
    Route::put('/dashboard/house/profile/update', [DashboardHouseController::class, 'updateProfile'])->name('house.profile.update');
    Route::post('/houses/reservation/{reservation}/status', [DashboardHouseController::class, 'updateStatus'])->name('dashboard.houses.reservation.status');
});


// Chat routes
// Inside the existing auth middleware group
Route::middleware(['auth'])->group(function () {
    Route::get('/chat/messages', [App\Http\Controllers\ChatController::class, 'getMessages'])->name('chat.messages');
    Route::post('/chat/send', [App\Http\Controllers\ChatController::class, 'sendMessage'])->name('chat.send');
    Route::get('/chat/consultant/{consultantId}', [App\Http\Controllers\ChatController::class, 'getConsultantDetails'])->name('chat.consultant');

    // New consultant chat route
    Route::get('/consultant/chat', [App\Http\Controllers\ChatController::class, 'consultantChat'])->name('consultant.chat');

    // Pusher authentication route
    Route::post('/broadcasting/auth', [App\Http\Controllers\ChatController::class, 'auth']);
});


// Route::middleware(['auth'])->group(function () {
//     Route::get('/payment', [App\Http\Controllers\PaymentController::class, 'showPaymentForm'])->name('payment');
//     Route::post('/process-payment', [App\Http\Controllers\PaymentController::class, 'processPayment'])->name('process.payment');
// Route::post('/checkout', [App\Http\Controllers\PaymentController::class, 'purchase'])->name('checkout.payment');
// Route::get('/payment/success', [App\Http\Controllers\PaymentController::class, 'handlePaymentSuccess'])->name('payment.success');
// });
// Route::middleware(['auth'])->group(function () {
    Route::get('/payment/{orderId}', [PaymentController::class, 'index'])->name('payment');
    Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('process.payment');
// });
