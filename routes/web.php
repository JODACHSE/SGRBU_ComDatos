<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

// Rutas públicas
Route::get('/', fn() => view('welcome'))->name('welcome');
Route::view('/wireframe', 'wireframe')->name('wireframe');
Route::view('/diagrama-de-analisis', 'diagrama-de-analisis')->name('diagrama');
Route::view('/arquitectura', 'arquitectura')->name('arquitectura');
Route::view('/modelos', 'modelos')->name('modelos');

// Autenticación
Route::middleware('guest')->group(function () {
    Route::get('/login', fn() => redirect('/?auth_tab=login'))->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    
    Route::get('/password/reset', fn() => redirect('/?auth_tab=reset'))->name('password.request');
    Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
});

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Rutas protegidas
Route::middleware(['auth'])->group(function () {
    
    // Home para todos
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    // Rutas para Admin y Staff (Gestión completa)
    Route::middleware(['role:admin,staff'])->group(function () {
        Route::resource('users', App\Http\Controllers\UserController::class);
        Route::resource('resources', App\Http\Controllers\ResourceController::class);
        Route::resource('campuses', App\Http\Controllers\CampusController::class);
        Route::resource('campus-programs', App\Http\Controllers\CampusProgramController::class);
        Route::resource('contacts', App\Http\Controllers\ContactController::class);
        Route::resource('contact-types', App\Http\Controllers\ContactTypeController::class);
        Route::resource('document-types', App\Http\Controllers\DocumentTypeController::class);
        Route::resource('genders', App\Http\Controllers\GenderController::class);
        Route::resource('programs', App\Http\Controllers\ProgramController::class);
        Route::resource('program-types', App\Http\Controllers\ProgramTypeController::class);
        Route::resource('resource-statuses', App\Http\Controllers\ResourceStatusController::class);
        Route::resource('resource-types', App\Http\Controllers\ResourceTypeController::class);
        Route::resource('loan-resources', App\Http\Controllers\LoanResourceController::class);
        Route::resource('loan-evidences', App\Http\Controllers\LoanEvidenceController::class);
        Route::view('/catalogs', 'modules.catalogs.index')->name('catalogs.index');
    });

    // Préstamos - Accesible para todos los roles
    Route::resource('loans', App\Http\Controllers\LoanController::class);

    // Perfil para todos los roles autenticados
    Route::get('/my-profile', [App\Http\Controllers\UserController::class, 'profile'])->name('users.profile');

    Route::middleware(['role:profesor'])->group(function () {
        Route::get('/inventory', [App\Http\Controllers\ResourceController::class, 'index'])->name('inventory.index');
        Route::get('/inventory/{resource}', [App\Http\Controllers\ResourceController::class, 'show'])->name('inventory.show');
    });

    // Rutas solo para Admin
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/users/trashed', [App\Http\Controllers\UserController::class, 'trashed'])->name('users.trashed');
        Route::post('/users/{id}/restore', [App\Http\Controllers\UserController::class, 'restore'])->name('users.restore');
        Route::delete('/users/{id}/force-delete', [App\Http\Controllers\UserController::class, 'forceDelete'])->name('users.force-delete');
    });
});