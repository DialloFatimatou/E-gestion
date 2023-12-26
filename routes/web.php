<?php

use App\Http\Controllers\commandeControllers;
use App\Http\Controllers\EntrepotsController;
use App\Http\Controllers\produitControllers;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\pdfControllers;
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
    //produits
    Route::get('/produits', [produitControllers::class, 'index'])->name('produits');
    Route::post('/ajout_produits', [produitControllers::class, 'AjoutProduit'])->name('ajout_produit');
    Route::put('/update_produit/{id}', [produitControllers::class, 'updateProduit'])->name('update_produit');
    Route::delete('/delete_produit/{id}', [produitControllers::class, 'deleteProduit'])->name('delete_produit');

    //categories
    Route::get('/categories', [produitControllers::class, 'indexCat'])->name('categories');
    Route::post('/ajout_categories', [produitControllers::class, 'AjoutCat'])->name('ajout_categorie');
    Route::put('/update_categorie/{id}', [produitControllers::class, 'updateCat'])->name('update_categorie');
    Route::delete('/delete_categorie/{id}', [produitControllers::class, 'deletecategorie'])->name('delete_categorie');

        // editer
        Route::get('createAppro/{id}', [approvisionnementControllers::class, 'createAppro'])->name('createAppro');

        // ajoute le produtit au panier
        Route::post('appro/{id}', [approvisionnementControllers::class, 'panierAppro'])->name('panierAppro');
    
        // panier approvisionnement
        Route::get('detail/appro', [approvisionnementControllers::class, 'detailAppro'])->name('detailAppro');
    
        // ajout
        Route::post('createAppro', [approvisionnementControllers::class, 'saveAppro'])->name('saveAppro');
    
        // affichage
        Route::get('displayAppro', [approvisionnementControllers::class, 'displayAppro'])->name('displayAppro');

        // enregistrement
        Route::post('commandes', [commandeControllers::class, 'registerCmdProduit'])->name('registerCmdProduit');

        // commande en attente
        Route::get('commandes', [commandeControllers::class, 'commande'])->name('commande');
    
        // commande valide
        Route::get('commandes/valide', [commandeControllers::class, 'CmdValideProduit'])->name('CmdValideProduit');
    
        // detail commande
        Route::get('commandes/detail/{id}', [commandeControllers::class, 'detailCmdProduit'])->name('detailCmdProduit');

        Route::get('livraison/enattente', [commandeControllers::class, 'liraisonEnCourProduit'])->name('liraisonEnCourProduit');
        Route::get('livraison/valide', [commandeControllers::class, 'liraisonEffectueProduit'])->name('liraisonEffectueProduit');
        
        
        Route::get('produit/pdf', [pdfControllers::class, 'seeproduits'])->name('pdfProduit');

});

// gestion des routes des utilisateur
Route::middleware(['auth', 'fonctions:2'])->group(function () {
    // home user
    Route::get('/user', [produitControllers::class, 'homeUser'])->name('homeUser');
    //Selection et ajout d'un produit au panier
    Route::get('/produit/{id}', [produitControllers::class, 'select'])->name('select_prod');
    Route::put('/addtocart/{id}', [CartController::class, 'addCart'])->name('addtocart');
    Route::get('/panier', [CartController::class, 'panier'])->name('panier');
    Route::put('/panier/updateqty/{id}', [CartController::class, 'updateqty'])->name('updateCart');
    Route::get('/panier/removeitem/{id}',[CartController::class, 'removeitem'])->name('removeitem');
    
    Route::put('panier/vente', [venteControllers::class, 'registerVenteProduit'])->name('registerVenteProduit');
});

// gestion des routes du super_admin
Route::middleware('super_admin')->group(function () {
    Route::get('/super_admin', function () {
        return view('home.super_admin');
    })->name('superAdmins');
    //gestion des entrepôts
    Route::get('/liste_entrepots', [EntrepotsController::class, 'lister'])->name('entrepots');
    Route::post('/ajout_entrepots', [EntrepotsController::class, 'registerEntrepot'])->name('ajout_entrepot');

    Route::get('/approisionnement', [approvisionnementControllers::class, 'allApprovi'])->name('allApprovi');
    ///////////////////// Gestion des routes des commandes ////////////////

    Route::get('/commandes/effectuer', [commandeControllers::class, 'cmdEffectuer'])->name('cmdEffectuer');
    Route::get('/commandes/enattente', [commandeControllers::class, 'cmdEnAttente'])->name('cmdEnAttente');
    Route::get('/commandes/{id}', [commandeControllers::class, 'detailCommande'])->name('detailCommande');
    ///////////////////// Gestion des routes des Chauffeurs ////////////////

    Route::get('/chauffeurs', [chauffeurControllers::class, 'allChauffeur'])->name('allChauffeur');
    Route::post('/chauffeurs', [chauffeurControllers::class, 'registerChauffeur'])->name('registerChauffeur');
    Route::get('/livraisons/chauffeur/{id}', [livraisonControllers::class, 'livraisonChauffeur'])->name('livraisonChauffeur');

    Route::get('/toutes/Livraisons', [livraisonControllers::class, 'toutesLivraison'])->name('toutesLivraison');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
