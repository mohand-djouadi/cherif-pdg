<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ActualiteController;
use App\Http\Controllers\CarrouselController;
use App\Http\Controllers\SecteurController;
use App\Http\Controllers\FilialeController;
use App\Http\Controllers\MaterielController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Models\User;

Route::get('/create_user', [AuthController::class, 'create_user'])->name('create_user');

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthController::class, 'store'])->name('login.store');
});



Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'destroy'])
        ->name('logout');

    Route::get('/dashboard', function () {
        return  view('pages/admin/dashboard');
    })->name('dashboard');

    Route::get('/admin-actualites', [ActualiteController::class, 'index'])->name('admin.actualites');

    Route::get('/admin-actualites/create', [ActualiteController::class, 'create'])->name('admin.actualites.create');
    Route::post('/admin-actualites/store', [ActualiteController::class, 'store'])->name('admin.actualites.store');
    Route::post('/admin-actualites/destroy/{id}', [ActualiteController::class, 'destroy'])->name('admin.actualites.destroy');
    Route::get('/admin-actualites/edit/{id}', [ActualiteController::class, 'edit'])->name('admin.actualites.edit');
    Route::post('/admin-actualites/update/{id}', [ActualiteController::class, 'update'])->name('admin.actualites.update');
    Route::get('/admin-actualites/detail/{id}', [ActualiteController::class, 'show'])->name('admin.actualites.show');


    Route::post('/admin-actualites/publication/{id}', [ActualiteController::class, 'publication'])->name('admin.actualites.publication');

    Route::post('/upload_summernote', [ActualiteController::class, 'upload_summernote'])
        ->name('actualite.upload_summernote');


    Route::post('/remove_summernote', [ActualiteController::class, 'remove_summernote'])
        ->name('actualite.remove_summernote');

    Route::get('/admin-appel-offres', function () {
        return  view('pages/admin/appel_offer');
    })->name('admin.appel.offres');



    // ------------------------------------------------ Secteur d'activité  ------------------------------------------
    Route::get('/admin-secteurs', [SecteurController::class, 'index'])->name('admin.secteurs');
    Route::get('/admin-secteurs-get', [SecteurController::class, 'get'])->name('admin.secteurs.get');
    Route::post('/admin-secteurs-store', [SecteurController::class, 'store'])->name('admin.secteurs.store');
    Route::delete('/admin-secteurs-destroy/{id}', [SecteurController::class, 'destroy'])->name('admin.secteurs.destroy');
    Route::get('/admin-secteurs-edit/{id}', [SecteurController::class, 'edit'])->name('admin.secteurs.edit');
    Route::post('/admin-secteurs-update/{id}', [SecteurController::class, 'update'])->name('admin.secteurs.update');
    Route::get('/admin-secteurs/{etat}/{id?}', [SecteurController::class, 'secteur'])->name('admin.secteurs.secteur');


    // ------------------------------------------------ Filiale  ------------------------------------------

    Route::get('/gestion-filiales',[FilialeController::class, 'index'])->name('gestion.filiales');
    Route::get('/gestion-filiales-get', [FilialeController::class, 'get'])->name('gestion.filiales.get');
    Route::post('/gestion-filiales-store',[FilialeController::class, 'store'])->name('gestion.filiales.store');
    Route::delete('/gestion-filiales-destroy/{id}', [FilialeController::class, 'destroy'])->name('gestion.filiales.destroy');
    Route::get('/gestion-filiales-edit/{id}', [FilialeController::class, 'edit'])->name('gestion.filiales.edit');
    Route::post('/gestion-filiales-update/{id}', [FilialeController::class, 'update'])->name('gestion.filiales.update');
    Route::get('/gestion-filiales-coordonne', [FilialeController::class, 'getCoordonne'])->name('gestion.filiales.getcoordonne');

    // ------------------------------------------------ Project  ------------------------------------------

    Route::get('/gestion-projets',[ProjectController::class, 'index'])->name('gestion.projet');
    Route::post('/gestion-projets-add',[ProjectController::class, 'store'])->name('gestion.projet.store');
    Route::get('/gestion-projets-get',[ProjectController::class, 'get'])->name('gestion.projet.get');
    Route::get('/gestion-projets-edit/{id}',[ProjectController::class, 'edit'])->name('gestion.projet.edit');
    Route::get('/gestion-projets-destroy/{id}',[ProjectController::class, 'destroy'])->name('gestion.projet.destroy');
    Route::get('/gestion-projets-delete-image/{id}',[ProjectController::class, 'deleteImg'])->name('gestion.projet.deleteImg');
    Route::post('/gestion-projets-update/{id}',[ProjectController::class, 'update'])->name('gestion.projet.update');

  // ------------------------------------------------ Materiel  ------------------------------------------
  Route::get('/gestion-materiel',[MaterielController::class, 'index'])->name('gestion.materiel');
  Route::post('/gestion-materiel-add',[MaterielController::class, 'store'])->name('gestion.materiel.store');
  Route::get('/gestion-materiel-get',[MaterielController::class, 'get'])->name('gestion.materiel.get');
  Route::get('/gestion-materiel-destroy/{id}',[MaterielController::class, 'destroy'])->name('gestion.materiel.destroy');
  Route::get('/gestion-materiel-edit/{id}',[MaterielController::class, 'edit'])->name('gestion.materiel.edit');
  Route::post('/gestion-materiel-update/{id}',[MaterielController::class, 'update'])->name('gestion.materiel.update');
  Route::get('/gestion-materiel-publie/{id}',[MaterielController::class, 'publie'])->name('gestion.materiel.publie');


   // ------------------------------------------------ Materiel  ------------------------------------------
   Route::get('/gestion-carrousel',[CarrouselController::class, 'index'])->name('gestion.carrousel');
   Route::post('/gestion-carrousel-add',[CarrouselController::class, 'store'])->name('gestion.carrousel.store');
   Route::get('/gestion-carrousel-get',[CarrouselController::class, 'get'])->name('gestion.carrousel.get');
   Route::get('/gestion-carrousel-delete-image/{id}',[CarrouselController::class, 'deleteImg'])->name('gestion.carrousel.deleteImg');
   Route::get('/gestion-carrousel-update-image-principale/{id}',[CarrouselController::class, 'updateImgPrincipale'])->name('gestion.carrousel.update.imgPrincipale');

     // ------------------------------------------------ gestion utilisateur  ------------------------------------------
     Route::get('/gestion-utilisateurs', [UserController::class, 'index'])->name('gestion.utilisateurs');
     Route::post('/gestion-utilisateurs/update-MDP', [UserController::class, 'updateMdp'])->name('admin.user.updateMdp');


});
