<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use APP\Http\Controllers\API\AuthController;

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
    return view('pages.search');
});

Route::get('/search', [HomeController::class, 'search'])->name('flight.offer.search');
Route::post('/flight-price', [HomeController::class, 'validateFlightPrice'])->name('flight.offer.price');
Route::post('/book-flight', [HomeController::class, 'flightBooking'])->name('book.flight');
// /applicant-info/{id}
Route::post('/home', [HomeController::class, 'home'])->name('frontend.home');

// Route::get('/api', [AuthController::class, 'auth']);
