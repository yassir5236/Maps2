<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItineraryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DestinationController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



// Routes d'authentification

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');




// routes/api.php


Route::middleware('auth:sanctum')->group(function () {
    // Route::post('/itineraires', [ItineraryController::class, 'store']);
    // Route::get('/itineraires/{id}', [ItineraryController::class, 'show']);
    // Route::put('/itineraires/{id}', [ItineraryController::class, 'update']);
    // Route::delete('/itineraires/{id}', [ItineraryController::class, 'destroy']);


    // Routes pour les itinéraires
Route::get('/itineraries', [ItineraryController::class, 'index']); // Afficher la liste des itinéraires
Route::get('/itineraries/{id}', [ItineraryController::class, 'show']); // Afficher les détails d'un itinéraire spécifique
Route::post('/itineraries', [ItineraryController::class, 'store']); // Créer un nouvel itinéraire
Route::put('/itineraries/{id}', [ItineraryController::class, 'update']); // Mettre à jour les informations d'un itinéraire
Route::delete('/itineraries/{id}', [ItineraryController::class, 'destroy']); // Supprimer un itinéraire

});






Route::middleware('auth:sanctum')->group(function () {
    // Routes protégées par Sanctum
});






// Routes pour les utilisateurs
Route::get('/users', [UserController::class, 'index']); // Afficher la liste des utilisateurs
Route::get('/users/{id}', [UserController::class, 'show']); // Afficher les détails d'un utilisateur spécifique
Route::put('/users/{id}', [UserController::class, 'update']); // Mettre à jour les informations d'un utilisateur
Route::delete('/users/{id}', [UserController::class, 'destroy']); // Supprimer un utilisateur





// Routes pour les destinations
Route::get('/destinations', [DestinationController::class, 'index']); // Afficher la liste des destinations
Route::get('/destinations/{id}', [DestinationController::class, 'show']); // Afficher les détails d'une destination spécifique
Route::post('/destinations', [DestinationController::class, 'store']); // Créer une nouvelle destination
Route::put('/destinations/{id}', [DestinationController::class, 'update']); // Mettre à jour les informations d'une destination
Route::delete('/destinations/{id}', [DestinationController::class, 'destroy']); // Supprimer une destination
