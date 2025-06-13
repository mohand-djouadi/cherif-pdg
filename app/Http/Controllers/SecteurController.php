<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SecteurActivite;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\SecteurActiviteRsource;

class SecteurController extends Controller
{
    public function index(Request $request)
    {

        $secteurs = SecteurActivite::orderby('updated_at', 'desc')->get();
        return  view('pages/admin/secteurs_activite/admine_secteur', compact('secteurs'));
    }

    public function secteur($etat, $id = null, Request $request)
    {
        if ($etat = 'create') {

            return  view('pages/admin/secteurs_activite/secteur_create&update');
        }
    }

    public function get(Request $request)
    {
        $secteurs = SecteurActivite::orderby('updated_at', 'desc')->get();
        return response()->json([
            'data' =>    SecteurActiviteRsource::collection($secteurs),

        ], 201);
    }


    public function store(Request $request)
    {

        // Définir les règles de validation
        $validator = Validator::make($request->all(), [
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string|max:500'
        ]);

        // Vérifier si la validation échoue
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Erreur de validation',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->all();
        DB::beginTransaction();
        try {
            SecteurActivite::create([
                'titre' => $data['titre'],
                'description' => $data['description']
            ]);
            DB::commit();

            // Retourner une réponse de succès
            return response()->json([
                'message' => 'Secteur d\'activité créé avec succès',

            ], 201);
        } catch (\Throwable $th) {
            DB::rollback();

            // Enregistrer l'erreur dans les logs
            Log::error('Erreur lors de la création du secteur d\'activité : ' . $th->getMessage());

            // Retourner une réponse d'erreur
            return response()->json([
                'message' => 'Erreur lors de la création du secteur d\'activité',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $secteur = SecteurActivite::findOrFail($id);
            $secteur->delete();

            return response()->json(['success' => 'Secteur d\'activité supprimé avec succès.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la suppression du secteur d\'activité.'], 500);
        }
    }
    public function edit($id)
    {
        try {
            $secteur = SecteurActivite::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Secteur d\'activité trouvé',
                'data' => $secteur
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération du secteur d\'activité.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $secteur = SecteurActivite::findOrFail($id);
            $secteur->update([
                'titre' => $request->titre,
                'description' => $request->description,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Secteur d\'activité mis à jour avec succès',
                'data' => $secteur
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour du secteur d\'activité.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
