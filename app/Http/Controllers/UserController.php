<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
               $users= User::get();

            return  view('pages/admin/gestionUtilisateurs/gestion_utilisateur',compact('users'));
    }
    public function create_user(Request $request)
    {

            return  view('pages/admin/gestion_utilisateur');

    }



public function updateMdp(Request $request)
{
    $request->validate([
        'mdp' => 'required|string|min:6', // Mot de passe actuel
        'new_mdp' => 'required|string|min:6|confirmed', // Nouveau mot de passe
    ], [], [
        'mdp' => 'mot de passe actuel',
        'new_mdp' => 'nouveau mot de passe',
    ]);

    DB::beginTransaction();
    try {
        // Vérifier si le mot de passe actuel est correct
        if (Hash::check($request->mdp, Auth::user()->password)) {
            // Mettre à jour avec le nouveau mot de passe haché
            Auth::user()->password = Hash::make($request->new_mdp);
            Auth::user()->save(); // Sauvegarder les modifications
        } else {
            // Si le mot de passe actuel est incorrect
            return response()->json([
                'message' => 'Le mot de passe actuel est incorrect',
            ], 422); // 422 pour validation échouée
        }

        DB::commit();
        return response()->json([
            'message' => 'Mot de passe mis à jour avec succès',
        ], 200);

    } catch (\Throwable $th) {
        DB::rollBack();
        return response()->json([
            'message' => 'Une erreur s\'est produite lors de la mise à jour du mot de passe',
        ], 500);
    }
}

}
