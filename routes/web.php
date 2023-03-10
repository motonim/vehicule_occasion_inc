<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\MarqueController;
use App\Http\Controllers\ModeleController;
use App\Http\Controllers\KmController;
use App\Http\Controllers\VoitureController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\PanierItemController;
use App\Http\Controllers\SecurityForgotPassword;
use App\Http\Controllers\PaiementPayPalController;
use App\Http\Livewire\FicheDetailVoiture;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Page d'acceuil
Route::get('/', [VoitureController::class, 'vedette'])->name('accueil');


// CHANGEMENT DE LANGUE
    Route::get('/lang/{locale}', [LocalizationController::class, 'index'])->name('lang');

// INSCRIPTION
    Route::get('/inscription', [CustomAuthController::class, 'create'])->name('user.registration');
    Route::post('/inscription', [CustomAuthController::class, 'store'])->name('user.store');

// PAGE UTILISATEUR
    Route::get('/profile/{user}', [CustomAuthController::class, 'edit'])->name('user.modification')->middleware('auth');
    Route::put('/profile/{user}', [CustomAuthController::class , 'update'])->name('user.modification')->middleware('auth');

// CONNEXION
    Route::get('/connexion', [CustomAuthController::class, 'index'])->name('connexion');
    Route::post('/connexion', [CustomAuthController::class, 'authentication'])->name('connexion.authentication');
    Route::get('/forgot_password', [SecurityForgotPassword::class, 'forgot'])->name('connexion.forgot');
    Route::post('/forgot_password', [SecurityForgotPassword::class, 'password'])->name('connexion.password');
    Route::get('/reset-password/{email}/{code}', [SecurityForgotPassword::class, 'reset'])->name('connexion.reset');
    Route::post('/reset-password/{email}/{code}', [SecurityForgotPassword::class, 'resetPassword'])->name('connexion.resetPassword');

// DECONNEXION
    Route::get('deconnexion', [CustomAuthController::class, 'logout'])->name('deconnexion');

// PAGE CATALOGUE
    // Route::get('/catalogue', [VoitureController::class, 'index'])->name('voiture.index');
    Route::get('/voiture', [VoitureController::class, 'index']);
    Route::get('/marque', [MarqueController::class, 'index']);
    Route::get('/modele', [ModeleController::class, 'index']);
    Route::get('/km', [KmController::class, 'index']);

    Route::view('/catalogue', 'client/voiture.index')->name('voiture.index');

// PAGE FICHE VOITURE
    // Route::get('/catalogue/voiture/vo-{voiture}', FicheDetailVoiture::class);
    Route::get('/catalogue/voiture/vo-{voiture}', [VoitureController::class, 'show'])->name('voiture.show');
    Route::post('/catalogue/voiture/vo-{voiture}', [PanierItemController::class, 'store'])->name('panier.store');

//PAGE MES COMMANDE
    Route::get('/mes-commandes', [CommandeController::class, 'index'])->name('commande.index')->middleware('auth');
    Route::get('/mes-commandes/{user}', [CustomAuthController::class, 'destroy'])->name('user.suppression')->middleware('auth');

// CLIENT - d??tail commande
    Route::get('/mes-commandes/co-{commande}', [CommandeController::class, 'show'])->name('commande.detail')->middleware('auth');

//Client - annuler la  commande (suppression)
    Route::get('/mes-commandes/annulation/co-{commande}', [CommandeController::class, 'destroy'])->name('commande.annulation')->middleware('auth');


// PAGE PANNEAU ADMIN
    //liste des voitures
    Route::get('/dashboard', [VoitureController::class, 'liste'])->name('voiture.liste')->middleware('auth');

    //Ajout et enregistrement d'une voiture
    Route::get('/dashboard/voiture-ajout', [VoitureController::class, 'create'])->name('voiture.ajout')->middleware('auth');
    Route::post('/dashboard/voiture-ajout', [VoitureController::class, 'store'])->name('voiture.enregistrer')->middleware('auth');

    //Modification d'une voiture
    Route::get('/dashboard/voiture-modification/-{voiture}', [VoitureController::class, 'edit'])->name('voiture.modification')->middleware('auth');
    Route::put('/dashboard/voiture-modification/-{voiture}', [VoitureController::class , 'update'])->name('voiture.modification')->middleware('auth');
    //Suppression de l'image dans le formulaire de modification
    Route::get('/dashboard/voiture/image/suppression/-{voiture_image_id}', [VoitureController::class, 'destroyImage'])->name('image.suppression')->middleware('auth');

    //Suppression d'une voiture
    Route::get('/dashboard/voiture-suppression/-{voiture}', [VoitureController::class, 'destroy'])->name('voiture.suppression')->middleware('auth');

    //Liste des commandes
    Route::get('/dashboard/commande', [CommandeController::class, 'liste'])->name('commande.liste')->middleware('auth');

    //D??tail commande
    Route::get('/dashboard/commande/co-{commande}', [CommandeController::class, 'edit'])->name('commande.show')->middleware('auth');

    //finaliser la  commande
    Route::put('/dashboard/commande/co-{commande}', [CommandeController::class, 'update'])->name('commande.final')->middleware('auth');

// PAGE CONTACT
    Route::get('/contactez-nous', function () {return view('static.contact');})->name('contactez-nous');

// PAGE APROPOS
    Route::get('/apropos', function () {return view('static.apropos');})->name('apropos');

// PAGE POLITIQUES DE VENTE
    Route::get('/politiques', function () {return view('static.politiques');})->name('politiques');

// PAGE PANIER
    Route::get('/panier', [PanierItemController::class, 'index'])->name('panier.index');
    Route::get('/panier/{voiture}', [PanierItemController::class, 'destroy'])->name('panier.suppression');
    Route::get('/reserver', [PanierItemController::class, 'reserver'])->name('panier.reserver');
    Route::post('/reserver', [CommandeController::class, 'store'])->name('commande.store');
    Route::post('/panier', [PaiementPayPalController::class, 'pay'])->name('commande.paypal');
    Route::get('/success', [PaiementPayPalController::class, 'success'])->name('commande.success');
    Route::get('/error', [PaiementPayPalController::class, 'error'])->name('commande.error');

// Affiche la facture pdf
    Route::get('/facture/PDF/{facture}', [CommandeController::class, 'facturePdf'])->name('facture.pdf');

    
