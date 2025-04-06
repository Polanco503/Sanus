<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\TreatmentsController;
use App\Http\Controllers\ReportsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Si quieres redirigir la raíz al login:
Route::get('/', function() {
    return redirect('/login');
});

// Autenticación de Laravel (login, registro, logout, etc.)
Auth::routes();

// Agrupa rutas protegidas
Route::middleware(['auth'])->group(function() {
    // Página principal tras el login
    Route::get('/home', function () {
        return view('home');
    })->name('home');
    
    // Citas
    Route::get('/appointments', [AppointmentsController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/create', [AppointmentsController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentsController::class, 'store'])->name('appointments.store');
    Route::get('/appointments/{appointment}/edit', [AppointmentsController::class, 'edit'])->name('appointments.edit');
    Route::put('/appointments/{appointment}', [AppointmentsController::class, 'update'])->name('appointments.update');
    Route::delete('/appointments/{appointment}', [AppointmentsController::class, 'destroy'])->name('appointments.destroy');

    // Tratamientos
    Route::get('/treatments', [TreatmentsController::class, 'index'])->name('treatments.index');
    Route::get('/treatments/create', [TreatmentsController::class, 'create'])->name('treatments.create');
    Route::post('/treatments', [TreatmentsController::class, 'store'])->name('treatments.store');
    Route::get('/treatments/{treatment}/edit', [TreatmentsController::class, 'edit'])->name('treatments.edit');
    Route::put('/treatments/{treatment}', [TreatmentsController::class, 'update'])->name('treatments.update');
    Route::delete('/treatments/{treatment}', [TreatmentsController::class, 'destroy'])->name('treatments.destroy');

    // Reportes
    Route::get('/reports', [ReportsController::class, 'index'])->name('reports.index');
});
