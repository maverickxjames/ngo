<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('guest')->group(function () {
    Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register.form');
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login.form');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('mpin', [AuthController::class, 'verifyMpin'])->name('mpin.verify');
    Route::get('mpin', [AuthController::class, 'showMpinForm'])->name('mpin.verify.form');
    // Activation payment callback
    Route::post('payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');
});

// Authenticated user routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    // Bank details
    Route::get('bank', [DashboardController::class, 'editBankDetails'])->name('bank.edit');
    Route::post('bank', [DashboardController::class, 'updateBankDetails'])->name('bank.update');
    // Referral tree
    Route::get('referrals', [ReferralController::class, 'index'])->name('referrals.index');
    Route::get('team/tree', [ReferralController::class, 'tree'])->name('referrals.tree');
});

// Admin routes
Route::middleware(['auth', 'role:Super Admin|Finance Admin|Support Admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('users', [AdminController::class, 'users'])->name('users');
    Route::post('users/{user}/status', [AdminController::class, 'updateUserStatus'])->name('users.updateStatus');
    Route::get('payments', [AdminController::class, 'payments'])->name('payments');
    Route::get('earnings', [AdminController::class, 'earnings'])->name('earnings');
    Route::get('payouts', [AdminController::class, 'payouts'])->name('payouts');
    Route::post('payouts/{user}/pay', [AdminController::class, 'payOut'])->name('payouts.pay');
});

require __DIR__.'/auth.php';
