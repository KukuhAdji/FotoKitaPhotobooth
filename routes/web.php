<?php

// Gabungkan ke routes/web.php, di luar middleware auth. Pertahankan route lainnya.
use App\Http\Controllers\GuestReviewController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;

// GANTI Route::view('/', 'pages.landing') lama, jangan membuat dua route GET '/'.
Route::get('/', [LandingPageController::class, 'index'])->name('home');
Route::get('/reviews', [GuestReviewController::class, 'index'])->name('reviews.index');
Route::post('/reviews', [GuestReviewController::class, 'store'])
    ->middleware('throttle:3,1')
    ->name('reviews.store');
Route::view('/about', 'pages.about')->name('about');
Route::view('/services', 'pages.services')->name('services');
Route::view('/booking', 'pages.booking')->name('booking');
Route::view('/contact', 'pages.contact')->name('contact');
Route::view('/gallery', 'pages.gallery')->name('gallery');
Route::view('/location', 'pages.location')->name('location');
