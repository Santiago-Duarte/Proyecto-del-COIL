<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\VeterinarianController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Página inicial: redirige al login si no está autenticado, al dashboard si lo está.
Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

// Login, registro, recuperación y confirmación de contraseña (laravel/ui).
Auth::routes();

// Rutas privadas: todas exigen una sesión iniciada.
Route::middleware('auth')->group(function () {
    // Panel principal con métricas en tiempo real.
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD de propietarios.
    Route::resource('owners', OwnerController::class)->parameters(['owners' => 'owner']);

    // CRUD de veterinarios.
    Route::resource('veterinarians', VeterinarianController::class)->parameters(['veterinarians' => 'veterinarian']);
    Route::patch('veterinarians/{veterinarian}/estado', [VeterinarianController::class, 'updateStatus'])->name('veterinarians.estado');

    // CRUD de mascotas.
    Route::resource('pets', PetController::class)->parameters(['pets' => 'pet']);

    // CRUD de citas médicas.
    Route::resource('appointments', AppointmentController::class)->parameters(['appointments' => 'appointment']);
    Route::patch('appointments/{appointment}/status', [AppointmentController::class, 'updateStatus'])->name('appointments.status');
});
