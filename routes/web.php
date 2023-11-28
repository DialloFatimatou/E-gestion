<?php
use App\Http\Controllers\commandeControllers;
use App\Http\Controllers\pdfControllers;
use App\Http\Controllers\produitControllers;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\stationControllers;
use App\Http\Controllers\superAdminControllers;
use App\Http\Controllers\venteControllers;
use Illuminate\Support\Facades\Route;

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
    return view('auth/login');
});

/* le terme panier est mis pour faire reférence au fais de stocker les informations de façon temporaires */

// gestion des routes de l'admin
Route::middleware(['auth', 'fonctions:1'])->group(function () {
     /////////////// Home de l'admin
     Route::get('/admin', [produitControllers::class, 'homeAdmin'])->name('homeAdmin');
    


   

});

// gestion des routes des utilisateur
Route::middleware(['auth', 'fonctions:2'])->group(function () {
     // home user
     Route::get('/user', [produitControllers::class, 'homeUser'])->name('homeUser');

 

});

// gestion des routes du super_admin
Route::middleware('super_admin')->group(function () {
    Route::get('/super_admin', function () {
        return view('home.super_admin');
    })->name('superAdmins');
   

   

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
