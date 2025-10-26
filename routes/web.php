<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WebsiteController;

use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Support\Facades\Response;

Route::get('/sitemap.xml', function () {
    $sitemap = Sitemap::create();

    // Public pages
$sitemap
    ->add(Url::create('/')
        ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
        ->setPriority(1.0))
    ->add(Url::create('/about-us')
        ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
        ->setPriority(0.8))
    ->add(Url::create('/contact-us')
        ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
        ->setPriority(0.8))
    ->add(Url::create('/login')
        ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
        ->setPriority(0.3))
    ->add(Url::create('/register')
        ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
        ->setPriority(0.3))
    ->add(Url::create('/terms')
        ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
        ->setPriority(0.5))
    ->add(Url::create('/privacy-policy')
        ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
        ->setPriority(0.5));


    return Response::make($sitemap->render(), 200, [
        'Content-Type' => 'application/xml'
    ]);
});



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
    // Route::post('mpin', [AuthController::class, 'verifyMpin'])->name('mpin.verify');
    // Route::get('mpin', [AuthController::class, 'showMpinForm'])->name('mpin.verify.form');
    // Activation payment callback
    Route::post('payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');

    Route::get('/about-us', [WebsiteController::class,'about'])->name('about');
    Route::get('/contact-us', [WebsiteController::class,'contact'])->name('contact');


});

// Authenticated user routes
Route::middleware(['auth', 'verified','verify.mpin'])->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    // Bank details
    Route::get('bank', [DashboardController::class, 'editBankDetails'])->name('bank.edit');
    Route::post('bank', [DashboardController::class, 'updateBankDetails'])->name('bank.update');
    // Referral tree
    Route::get('referrals', [ReferralController::class, 'index'])->name('referrals.index');
    Route::get('team/tree', [ReferralController::class, 'tree'])->name('referrals.tree');

    Route::get('payouts', [DashboardController::class, 'payouts'])->name('user.payouts');
    Route::get('support', [DashboardController::class, 'support'])->name('user.support');
    Route::get('privacy-policy', [DashboardController::class, 'privacypolicy'])->name('user.privacypolicy');

    Route::get('terms', [DashboardController::class, 'terms'])->name('user.terms');
    Route::get('about', [DashboardController::class, 'about'])->name('user.about');

                Route::post('mpin', [AuthController::class, 'verifyMpin'])->name('mpin.verify');
    Route::get('mpin', [AuthController::class, 'showMpinForm'])->name('mpin.verify.form');





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

    Route::get('users/{user}', [AdminController::class, 'Usershow'])->name('users.show');

    Route::post('/users/{user}/update-mpin', [AdminController::class, 'updateMpin'])
    ->name('users.updateMpin');

    Route::put('users/{user}/update-personal', [AdminController::class, 'updatePersonal'])->name('users.updatePersonal');
Route::put('users/{user}/update-contact', [AdminController::class, 'updateContact'])->name('users.updateContact');
Route::put('users/{user}/update-bank', [AdminController::class, 'updateBank'])->name('users.updateBank');



});

require __DIR__.'/auth.php';
