<?php
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Models\Client;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::get('/', [LoginController::class, 'index'])->name('index');
Route::get('/login-form', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.submit');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [LoginController::class, 'showRegForm'])->name('showRegform');
Route::post('create/client', [LoginController::class, 'createUser'])->name('create');
Route::get('/check-email', [LoginController::class, 'checkEmail'])->name('checkEmail');

// Admin Routes
Route::middleware(['auth:admin', 'role:admin','prevent-back-history'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/manage_gallery', [AdminController::class, 'showManageGallery'])->name('manageGallery');
    Route::get('/manage_plan', [AdminController::class, 'showManagePlan'])->name('managePlan');
    Route::get('/manage_design', [AdminController::class, 'showManagedesign'])->name('manageDesign');
    Route::get('/feedbacks', [AdminController::class, 'viewFeedbacks'])->name('feedbacks');
    Route::get('/addplan', [AdminController::class, 'showPlanForm'])->name('addplan');
    Route::post('/admin/create-plan', [AdminController::class, 'createPlan'])->name('createPlan');
    Route::get('/admin/edit-plan/{id}', [AdminController::class, 'editPlan'])->name('editPlan');
    Route::put('/admin/update-plan/{id}', [AdminController::class, 'updatePlan'])->name('updatePlan');
    Route::get('/admin/delete-plan/{id}', [AdminController::class, 'deletePlan'])->name('deletePlan');
    Route::post('/admin/create-design', [AdminController::class, 'createDesign'])->name('createDesign');
    Route::get('/admin/edit-design/{id}', [AdminController::class, 'editDesign'])->name('editDesign');
    Route::put('/admin/update-design/{id}', [AdminController::class, 'updateDesign'])->name('updateDesign');
    Route::get('/admin/delete-design/{id}', [AdminController::class, 'deleteDesign'])->name('deleteDesign');
    Route::get('/manage_users', [AdminController::class, 'showManageusers'])->name('manageUsers');
    Route::get('/manage_staffs', [AdminController::class, 'showManagestaffs'])->name('manageStaffs');
    Route::get('/manage_clients', [AdminController::class, 'showManageclients'])->name('manageClients');
    Route::get('/requests', [AdminController::class, 'showrequests'])->name('viewRequests');
    Route::get('/client-profile', [AdminController::class, 'showClient'])->name('clientPrtofile');
    Route::post('/add-staff', [AdminController::class, 'addStaff'])->name('addStaff');
    Route::get('/view-staff-profile/{id}', [AdminController::class, 'viewstaffprofile'])->name('viewstaffprofile');
    Route::put('/update-Staff-profile/{id}', [AdminController::class, 'updateStaff'])->name('updateStaff');
    Route::put('/changePswds-staff/{id}', [AdminController::class, 'changePswd'])->name('changePswd');
    Route::get('/delete-staff/{id}', [AdminController::class, 'deleteStaff'])->name('deleteStaff');
    Route::get('/request-details/{id}',[ProjectController::class,'requestDetails'])->name('requestDetails');
    Route::put('/sendBudget/{id}',[ProjectController::class,'addBudget'])->name('sendBudget');
    route::put('/terminate-Request/{id}',[ProjectController::class,'terminateRequest'])->name('terminateRequest');
    Route::get('/projects', [ProjectController::class, 'showprojects'])->name('viewProjects');
    route::put('/terminate-Project/{id}',[ProjectController::class,'terminateProject'])->name('terminateProject');
    Route::post('/assignStaff', [ProjectController::class, 'assignStaff'])->name('assignStaff');
    Route::get('/project/view-bill/{id}',[ProjectController::class,'viewBill'])->name('viewBill');
    
    Route::get('/feedbacks', [AdminController::class, 'viewFeedbacks'])->name('feedbacks');
 });

 // Client Routes
Route::middleware(['auth:client', 'role:client','prevent-back-history'])->prefix('client')->name('client.')->group(function () {
    Route::get('/dashboard', [ClientController::class, 'dashboard'])->name('dashboard');
    Route::get('/planGallery', [ClientController::class, 'planGallery'])->name('plansGallery');
    Route::get('/designGallery', [ClientController::class, 'designGallery'])->name('designsGallery');
    Route::get('/profile/{id}', [ClientController::class, 'viewProfile'])->name('viewprofile');
    Route::get('/edit-profile/{id}', [ClientController::class, 'viewEditProfile'])->name('editprofile');
    Route::put('/update-profile/{id}', [clientController::class, 'updateProfile'])->name('updateProfile');
    Route::put('/changePswd/{id}', [clientController::class, 'changePswd'])->name('changePswd');
    Route::get('/project-enquiry', [ProjectController::class, 'Projectenquiry'])->name('ProjectEnquiry');
    Route::get('/new-project-enquiry', [ProjectController::class, 'enquiry'])->name('newEnquiry');
    Route::put('/refuseRequest/{id}',[ProjectController::class,'refuseRequest'])->name('refuseRequest');
    Route::put('/AcceptRequest/{id}',[ProjectController::class,'acceptRequest'])->name('acceptRequest');
    Route::get('/current-project-enquiry', [ProjectController::class, 'showEnquiry'])->name('Enquiry');
    Route::post('/request-plan', [ProjectController::class, 'requestPlan'])->name('requestPlan');
    Route::post('/request-design', [ProjectController::class, 'requestDesign'])->name('requestDesign');
    Route::get('/projects', [ClientController::class, 'viewProjects'])->name('projects');
    Route::get('/project/details/{id}', [ClientController::class, 'projectDetails'])->name('projectDetails');
    Route::get('/project/bill/{id}', [ClientController::class, 'viewBill'])->name('bill');
    Route::post('/make-payment/{id}', [ProjectController::class, 'makePayment'])->name('makePayment');
    Route::get('/feedback/{id}',[ClientController::class,'reviewForm'])->name('reviewForm');
    Route::post('/submit-feedback/{id}',[ClientController::class,'storeFeedback'])->name('storeFeedback');
    Route::get('/bills', [ClientController::class, 'viewBills'])->name('viewBills');

    Route::get('/plan-design-details', [ClientController::class, 'planDesignDetails'])->name('planDesignDetails');
    Route::get('/gallery', [ClientController::class, 'gallery'])->name('gallery');
});


// Architect Routes
Route::middleware(['auth:architect', 'role:architect','prevent-back-history'])->prefix('architect')->name('architect.')->group(function () {
    Route::get('/dashboard', [StaffController::class, 'dashboard'])->name('dashboard');
    Route::get('/plan-gallery', [StaffController::class, 'PlanGallery'])->name('planGallery');
    Route::post('/create-plan', [StaffController::class, 'createPlan'])->name('createPlan');
    Route::get('/edit-plan/{id}', [StaffController::class, 'viewPlanEditform'])->name('editform');
    Route::put('/update-plan/{id}', [StaffController::class, 'updatePlan'])->name('updatePlan');
    Route::get('/delete-plan/{id}', [StaffController::class, 'deletePlan'])->name('deletePlan');
    Route::get('/viewProjects', [StaffController::class, 'viewProjects'])->name('viewProjects');
    Route::put('/update/project/{id}', [StaffController::class, 'updateProject'])->name('updateProject');
    Route::get('/project/details/{id}', [StaffController::class, 'projectDetails'])->name('projectDetails');
    Route::get('/viewProfile', [StaffController::class, 'viewProfile'])->name('viewProfile');
});

// Designer Routes
Route::middleware(['auth:designer', 'role:designer'])->prefix('designer')->name('designer.')->group(function () {
    Route::get('/dashboard', [StaffController::class, 'dashboard'])->name('dashboard');
    Route::get('/design-gallery', [StaffController::class, 'designGallery'])->name('designGallery');
    Route::post('/create-design', [StaffController::class, 'createDesign'])->name('createDesign');
    Route::get('/edit-design/{id}', [StaffController::class, 'viewDesignEditform'])->name('editform');
    Route::put('/update-design/{id}', [StaffController::class, 'updateDesign'])->name('updateDesign');
    Route::get('/delete-design/{id}', [StaffController::class, 'deleteDesign'])->name('deleteDesign');
    Route::get('/viewProjects', [StaffController::class, 'viewProjects'])->name('viewProjects');
    Route::put('/update/project/{id}', [StaffController::class, 'updateProject'])->name('updateProject');
    Route::get('/project/details/{id}', [StaffController::class, 'projectDetails'])->name('projectDetails');
    Route::get('/viewProfile', [StaffController::class, 'viewProfile'])->name('viewProfile');
});

