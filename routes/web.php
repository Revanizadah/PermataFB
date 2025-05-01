<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminController; // Pastikan controller admin ditambahkan jika diperlukan
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route untuk redirect dashboard admin dan pengguna biasa
Route::middleware(['auth'])->get('/dashboard', function () {
    if (auth()->user()->role == 'admin') {
        return redirect()->route('admin.dashboard'); // Redirect ke admin dashboard jika admin
    }

    return view('dashboard'); // Dashboard untuk user biasa
})->name('dashboard');

// Rute untuk profile pengguna
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute Admin hanya dapat diakses oleh admin
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/manage-reception', [AdminController::class, 'manageReception'])->name('admin.manage.reception');
    Route::get('/admin/manage-fields', [AdminController::class, 'manageFields'])->name('admin.manage.fields');
    Route::get('/admin/manage-fields/futsal', [AdminController::class, 'manageFutsal'])->name('admin.manage.futsal');
    Route::get('/admin/manage-fields/badminton', [AdminController::class, 'manageBadminton'])->name('admin.manage.badminton');
    Route::get('/admin/reports', [AdminController::class, 'reports'])->name('admin.reports');
    // Menampilkan data pemesanan
    Route::middleware(['auth', 'is_admin'])->get('/admin/manage-reception', [AdminController::class, 'manageReception'])->name('admin.manage.reception');
    
    // Route untuk menerima pemesanan
    Route::middleware(['auth', 'is_admin'])->get('/admin/manage-reception/accept/{id}', [AdminController::class, 'acceptReservation'])->name('admin.accept');

    // Route untuk menolak pemesanan
    Route::middleware(['auth', 'is_admin'])->get('/admin/manage-reception/reject/{id}', [AdminController::class, 'rejectReservation'])->name('admin.reject');


});

// Rute untuk reservasi lapangan
Route::middleware('auth')->group(function () {
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
});

require __DIR__.'/auth.php';
