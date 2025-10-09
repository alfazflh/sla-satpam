<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminController;

// Halaman awal (welcome + form create) - INI YANG DIPAKAI!
Route::get('/', [FormController::class, 'create'])->name('welcome');
Route::post('/laporan/store', [FormController::class, 'store'])->name('laporan.store');

// Dashboard User
Route::get('/user', function () {
    return view('user.dashboard');
})->middleware(['auth', 'verified'])->name('user.dashboard');

// Dashboard Admin
Route::middleware(['auth', 'verified', AdminMiddleware::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

// Profile
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
        return redirect()->route('login');
    }

    return $user->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// CSRF refresh route untuk form
Route::get('/refresh-csrf', function () {
    return response()->json(['token' => csrf_token()]);
});

// Route auth bawaan Breeze
require __DIR__.'/auth.php';