<?php

use App\Http\Controllers\ActualiteController;
use App\Http\Resources\FilialeCoordonneResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FilialeController;
use App\Http\Controllers\MaterielController;
use App\Models\Filiale;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

Route::get('/test', function () {
    return view('test');

})->name('test');

Route::get('/', [ActualiteController::class, 'accueil'])->name('home');

Route::get( '/actualites/detail/{id}', [ActualiteController::class, 'show'])->name('actualite.show');
Route::get( '/actualites', [ActualiteController::class, 'listeActualite'])->name('actualite.listeActualite');


Route::get('/entreprises/{name?}', function ($name = null) {
    return  view('pages/filiale_detail')->with('name', $name);
})->name('entreprises');

Route::get('/groupe', function () {
    return  view('pages/legroupe');
})->name('groupe');

Route::get('/hommage', function () {
    return  view('pages/hommage');
})->name('hommage');

Route::get('/mot-dg', function () {
    return  view('pages/mot_dg');
})->name('mot-dg');


Route::get('/implantation', function () {
    $filiales = Filiale::get();
    $filialesResources = FilialeCoordonneResource::collection($filiales);

    return view('pages/implantation', ['filiales' => $filialesResources]);
})->name('implantation');


Route::get('/gestion-filiales-geInfo/{id}', [FilialeController::class, 'geInfo'])->name('gestion.filiales.geInfo');
Route::get('/projets/{id}', [ProjectController::class, 'getProjectDetail'])->name('nosProjets.detaille');
Route::get('/projets', [ProjectController::class, 'nosPrpjets'])->name('nosProjets');

Route::get('/notre-materiel', [MaterielController::class, 'notreMateriel'])->name('notreMateriel');


Route::get('/gouvernance', function () {
    return  view('pages/gouvernance');
})->name('gouvernance');



Route::get('/contact', function () {
    return  view('pages/contact');
})->name('contact');

Route::post('/submitForm', function (Request $request) {
    // Validation des données du formulaire
    $validated = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email',
        'subject' => 'required',
        'message' => 'required',
    ]);

    // Optionnel: Envoyer un email avec les détails du formulaire
    Mail::send([], [], function ($message) use ($validated) {
        $message->to('votre-email@example.com')
                ->subject('Nouveau message de contact')
                ->setBody('Nom: ' . $validated['name'] . "\n\n" . 'Email: ' . $validated['email'] . "\n\n" . 'Message: ' . $validated['message'], 'text/plain');
    });

    // Redirection après soumission
    return redirect()->route('contact')->with('success', 'Merci pour votre message, nous vous contacterons bientôt !');
})->name('mail.contact');

require __DIR__.'/auth.php';
