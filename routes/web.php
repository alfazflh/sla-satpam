<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Middleware\AdminMiddleware;

// Halaman awal (welcome page)
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/', [FormController::class, 'create'])->name('form.create');
Route::post('/store', [FormController::class, 'store'])->name('form.store');

// Dashboard User (semua user yang login bisa masuk, termasuk admin)
Route::get('/user', function () {
    return view('user.dashboard');
})->middleware(['auth', 'verified'])->name('user.dashboard');

// Dashboard Admin (hanya untuk admin role)
Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified', AdminMiddleware::class])->name('admin.dashboard');

// Profile (bisa diakses semua user yg login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Dashboard redirect sesuai role
Route::get('/dashboard', function () {
    /** @var User|null $user */
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login'); // fallback kalau belum login
    }

    return $user->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route auth bawaan Breeze (login, register, dll)
require __DIR__.'/auth.php';
