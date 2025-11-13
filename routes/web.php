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
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

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
        Route::resource('alerts', App\Http\Controllers\AlertController::class);

        // Rutas para Alertas
        Route::get('/alerts/trashed', [App\Http\Controllers\AlertController::class, 'trashed'])->name('alerts.trashed');
        Route::post('/alerts/{id}/restore', [App\Http\Controllers\AlertController::class, 'restore'])->name('alerts.restore');
        Route::delete('/alerts/{id}/force-delete', [App\Http\Controllers\AlertController::class, 'forceDelete'])->name('alerts.force-delete');

        // Rutas para Catálogos
        Route::get('/catalogs', [App\Http\Controllers\CatalogController::class, 'index'])->name('catalogs.index');
        Route::post('/catalogs/{catalog}/{id}/toggle-active', [App\Http\Controllers\CatalogController::class, 'toggleActive'])->name('catalogs.toggle-active');
        Route::get('/catalogs/{catalog}/create', [App\Http\Controllers\CatalogController::class, 'create'])->name('catalogs.create');
        Route::get('/catalogs/{catalog}/{id}', [App\Http\Controllers\CatalogController::class, 'show'])->name('catalogs.show');
        Route::get('/catalogs/{catalog}/{id}/edit', [App\Http\Controllers\CatalogController::class, 'edit'])->name('catalogs.edit');

        // Rutas para Evidencias de Préstamos
        Route::resource('loan-evidences', App\Http\Controllers\LoanEvidenceController::class);
        Route::get('/loan-evidences/trashed', [App\Http\Controllers\LoanEvidenceController::class, 'trashed'])->name('loan-evidences.trashed');
        Route::post('/loan-evidences/{id}/restore', [App\Http\Controllers\LoanEvidenceController::class, 'restore'])->name('loan-evidences.restore');
        Route::delete('/loan-evidences/{id}/force-delete', [App\Http\Controllers\LoanEvidenceController::class, 'forceDelete'])->name('loan-evidences.force-delete');
    });

    // Préstamos - Accesible para todos los roles
    Route::resource('loans', App\Http\Controllers\LoanController::class);

    // Perfil para todos los roles autenticados
    Route::prefix('profile')->group(function () {
        Route::get('/', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
        Route::get('/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    });

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
