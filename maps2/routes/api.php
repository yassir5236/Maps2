<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItineraryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\VisitsController;




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


Route::get('/itineraries/search', [ItineraryController::class, 'search']);

Route::get('/itineraries', [ItineraryController::class, 'index']); // Afficher la liste des itinéraires



Route::middleware('auth:sanctum')->group(function () {
Route::get('/itineraries/{id}', [ItineraryController::class, 'show']); // Afficher les détails d'un itinéraire spécifique
Route::post('/itineraires/add', [ItineraryController::class, 'store']); // Créer un nouvel itinéraire
Route::patch('/itineraries/{id}', [ItineraryController::class, 'update']); // Mettre à jour les informations d'un itinéraire
Route::delete('/itineraries/{id}', [ItineraryController::class, 'destroy']); // Supprimer un itinéraire
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

});








// // Routes pour les utilisateurs
// Route::get('/users', [UserController::class, 'index']); // Afficher la liste des utilisateurs
// Route::get('/users/{id}', [UserController::class, 'show']); // Afficher les détails d'un utilisateur spécifique
// Route::put('/users/{id}', [UserController::class, 'update']); // Mettre à jour les informations d'un utilisateur
// Route::delete('/users/{id}', [UserController::class, 'destroy']); // Supprimer un utilisateur






Route::middleware('auth:sanctum')->post('/itineraries/{id}/add-destinations', [ItineraryController::class, 'addDestinations']);

Route::middleware('auth:sanctum')->post('/visits', [VisitsController::class, 'store']);






Route::post('/itineraries/filtre', [ItineraryController::class, 'filtre']);

