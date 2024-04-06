<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ItineraryController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\StaticController;

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

Route::get('/inscription', function () {
    return view('Auth/creat_iteneraire');
});

// Route::get('/login', function () {
//     return view('Auth/login');
// });

// Route::get('/register', function () {
//     return view('Auth/register');





// route static pages
Route::get('/register', [StaticController::class, 'showRegister'])->name('showRegister');
Route::get('/login', [StaticController::class, 'showLogin'])->name('showLogin');

Route::get('/about', [StaticController::class, 'showAbout'])->name('about');
Route::get('/contact', [StaticController::class, 'showContact'])->name('showContact');
Route::get('/galery', [StaticController::class, 'showGalery'])->name('showGalery');
Route::get('/', [StaticController::class, 'showWelcome'])->name('showWelcome');



Route::get('/home', [UserController::class, 'homeUser'])->name('homeUser');










