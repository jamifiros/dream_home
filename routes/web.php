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


// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/manage_plan', [AdminController::class, 'showManagePlan'])->name('managePlan');
    Route::get('/manage_design', [AdminController::class, 'showManagedesign'])->name('manageDesign');
    Route::get('/feedbacks', [AdminController::class, 'viewFeedbacks'])->name('feedbacks');

    Route::get('/addplan', [AdminController::class, 'showPlanForm'])->name('addplan');
    Route::post('/createplan', [AdminController::class, 'createplan'])->name('create');


    Route::get('/architects', [AdminController::class, 'viewArchitects'])->name('architects');
    Route::get('/designers', [AdminController::class, 'viewDesigners'])->name('designers');
    Route::get('/clients', [AdminController::class, 'viewClients'])->name('clients');
    Route::get('/feedbacks', [AdminController::class, 'viewFeedbacks'])->name('feedbacks');
    Route::post('/register-architect', [AdminController::class, 'registerArchitect'])->name('registerArchitect');
    Route::post('/register-designer', [AdminController::class, 'registerDesigner'])->name('registerDesigner');
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

// Client Routes
Route::middleware(['auth', 'role:client'])->prefix('client')->name('client.')->group(function () {
    Route::get('/dashboard', [ClientController::class, 'dashboard'])->name('dashboard');
    Route::post('/request-plan', [ClientController::class, 'requestPlan'])->name('requestPlan');
    Route::post('/request-design', [ClientController::class, 'requestDesign'])->name('requestDesign');
    Route::get('/plan-design-details', [ClientController::class, 'planDesignDetails'])->name('planDesignDetails');
    Route::get('/gallery', [ClientController::class, 'gallery'])->name('gallery');
    Route::post('/feedback', [ClientController::class, 'submitFeedback'])->name('submitFeedback');
    Route::post('/make-payment', [ClientController::class, 'makePayment'])->name('makePayment');
});