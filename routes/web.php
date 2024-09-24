<?php
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArchitectController;
use App\Http\Controllers\DesignerController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.submit');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [LoginController::class, 'showRegForm'])->name('showRegform');
Route::post('create/client', [LoginController::class, 'createUser'])->name('create');
Route::get('/check-email', [LoginController::class, 'checkEmail'])->name('checkEmail');

// Admin Routes
Route::middleware(['auth', 'role:admin','prevent-back-history'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
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
    Route::get('/projects', [AdminController::class, 'showprojects'])->name('viewProjects');
    Route::get('/client-profile', [AdminController::class, 'showClient'])->name('clientPrtofile');
    Route::post('/add-staff', [AdminController::class, 'addStaff'])->name('addStaff');
    Route::get('/view-staff-profile/{id}', [AdminController::class, 'viewstaffprofile'])->name('viewstaffprofile');
    Route::put('/update-Staff-profile/{id}', [AdminController::class, 'updateStaff'])->name('updateStaff');
    Route::put('/changePswds-staff/{id}', [AdminController::class, 'changePswd'])->name('changePswd');
    Route::get('/delete-staff/{id}', [AdminController::class, 'deleteStaff'])->name('deleteStaff');
    Route::get('/feedbacks', [AdminController::class, 'viewFeedbacks'])->name('feedbacks');
 });

 // Client Routes
Route::middleware(['auth', 'role:client'])->prefix('client')->name('client.')->group(function () {
    Route::get('/dashboard', [ClientController::class, 'dashboard'])->name('dashboard');
    Route::get('/planGallery', [ClientController::class, 'planGallery'])->name('plansGallery');
    Route::get('/designGallery', [ClientController::class, 'designGallery'])->name('designsGallery');
    Route::get('/filter-plans', [ClientController::class, 'filterPlans'])->name('filterPlans');
   

    Route::post('/request-plan', [ClientController::class, 'requestPlan'])->name('requestPlan');
    Route::post('/request-design', [ClientController::class, 'requestDesign'])->name('requestDesign');
    Route::get('/plan-design-details', [ClientController::class, 'planDesignDetails'])->name('planDesignDetails');
    Route::get('/gallery', [ClientController::class, 'gallery'])->name('gallery');
    Route::post('/feedback', [ClientController::class, 'submitFeedback'])->name('submitFeedback');
    Route::post('/make-payment', [ClientController::class, 'makePayment'])->name('makePayment');
});


// Architect Routes
Route::middleware(['auth', 'role:architect'])->prefix('architect')->name('architect.')->group(function () {
    Route::get('/dashboard', [ArchitectController::class, 'dashboard'])->name('dashboard');
    Route::get('/requirements', [ArchitectController::class, 'viewRequirements'])->name('requirements');
    Route::post('/submit-plan', [ArchitectController::class, 'submitPlan'])->name('submitPlan');
    Route::get('/gallery', [ArchitectController::class, 'gallery'])->name('gallery');
    Route::get('/payments', [ArchitectController::class, 'payments'])->name('payments');
});

// Designer Routes
Route::middleware(['auth', 'role:designer'])->prefix('designer')->name('designer.')->group(function () {
    Route::get('/dashboard', [DesignerController::class, 'dashboard'])->name('dashboard');
    Route::get('/requirements', [DesignerController::class, 'viewRequirements'])->name('requirements');
    Route::post('/submit-design', [DesignerController::class, 'submitDesign'])->name('submitDesign');
    Route::get('/gallery', [DesignerController::class, 'gallery'])->name('gallery');
    Route::get('/payments', [DesignerController::class, 'payments'])->name('payments');
});

