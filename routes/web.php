<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Importo Controller Profilo
use App\Http\Controllers\Admin\DevProfileController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SponsorshipController;
//importo model Profile
use App\Models\Admin\Profile;
use App\Models\Admin\Sponsorship;
//importo Auth
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth',)->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rotta resource Profile
    Route::resource('/admin', DevProfileController::class);
    Route::resource('/reviews', ReviewController::class);
    Route::resource('/leads', LeadController::class);
    // Route::resource('/sponsorship', SponsorshipController::class);

    Route::get('/sponsorships', [SponsorshipController::class, 'index'])->name('sponsorships.index');
    Route::any('/sponsorships/payment/silver', [SponsorshipController::class, 'tokenSilver'])->name('tokenSilver');
    Route::any('/sponsorships/payment/gold', [SponsorshipController::class, 'tokenGold'])->name('tokenGold');
    Route::any('/sponsorships/payment/platinum', [SponsorshipController::class, 'tokenPlatinum'])->name('tokenPlatinum');
});




require __DIR__ . '/auth.php';
