<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContenusController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CommentairesController;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', function () {
    return view('front.accueil');
});

Route::get('/two-factor', [TwoFactorController::class, 'showVerifyForm'])->name('two-factor.showVerifyForm')->middleware('auth');
Route::post('/two-factor', [TwoFactorController::class, 'verifyCode'])->name('two-factor.verify')->middleware('auth');
Route::post('/two-factor/resend', [TwoFactorController::class, 'sendCode'])->name('two-factor.send')->middleware('auth');

Route::get('/', [ContenusController::class, 'accueil'])->name('contenusaccueil');
Route::get('/contenus/{id}/details', [ContenusController::class, 'details'])->name('contenusdetails');
Route::get('/contenustous', [ContenusController::class, 'tous'])->name('contenustous');

// Routes de paiement
Route::middleware('auth')->group(function () {
    Route::get('/payment/initiate/{contenuId}', [PaymentController::class, 'initiate'])->name('payment.initiate');
});

// Callback FedaPay (sans authentification car appelé depuis l'extérieur)
Route::get('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');

Route::middleware('auth')->group(function () {
    Route::post('/commentaires/user-store', [CommentairesController::class, 'userStore'])->name('commentaires.userStore');
});