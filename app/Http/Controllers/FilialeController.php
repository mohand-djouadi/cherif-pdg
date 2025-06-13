<?php

namespace App\Http\Controllers;

use App\Http\Resources\FilialeCoordonneResource;
use App\Http\Resources\FilialeResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Filiale;
use App\Models\SecteurActivite;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class FilialeController extends Controller
{
    public function index(Request $request)
    {

        $secteurs = SecteurActivite::get();
        return  view('pages/admin/filiale/admine_filiale', compact('secteurs'));
    }
    public function get(Request $request)
    {
        $secteurs = Filiale::orderby('updated_at', 'desc')->get();
        return response()->json([
            'data' =>    FilialeResource::collection($secteurs),

        ], 201);
    }

    public function store(Request $request)
    {

        $rules = [
            'denomination' => 'required|string|max:255',
            'site' => 'nullable|string|max:255',
            'sigle_commercial' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'nullable|string|max:10',
            'fixe' => 'nullable|string|max:10',
            'date_creation' => 'required|date',
            'capital' => 'required|numeric',
            'nom_du_dg' => 'required|string|max:255',  // Assurez-vous d'avoir cet input dans le formulaire
            'imgDirecteur' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'secteur' => 'required|integer',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ];

        // Valider les données de la requête
        $validator = Validator::make($request->all(), $rules);

        // Vérifier si la validation échoue
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();
        try {

            // Sauvegarde des fichiers image
            if ($request->hasFile('imgDirecteur')) {
                $imgDirecteurPath = $request->file('imgDirecteur')->store('images', 'public');
            }

            if ($request->hasFile('logo')) {
                $logoPath = $request->file('logo')->store('images', 'public');
            }

            // Création d'un nouvel enregistrement dans la base de données
            Filiale::create([
                'affiliation' => 'Groupe GITRAMA Spa',
                'site_web' => $request->site,
                'denomination' => $request->denomination,
                'sigle_commercial' => $request->sigle_commercial,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'fix' => $request->fixe,
                'date_creation' => $request->date_creation,
                'capital_social' => $request->capital,
                'nom_dg' => $request->nom_du_dg,
                'photo_dg' => $imgDirecteurPath ?? null,
                'logo_path' => $logoPath ?? null,
                'secteur_id' => $request->secteur,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);
            DB::commit();

            // Retourner une réponse de succès
            return response()->json([
                'message' => 'Filiale créé avec succès',

            ], 201);
        } catch (\Throwable $th) {
            DB::rollback();

            // Enregistrer l'erreur dans les logs
            Log::error('Erreur lors de la création de la Filiale : ' . $th->getMessage());

            // Retourner une réponse d'erreur
            return response()->json([
                'message' => "Erreur lors de la création de la Filiale",
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $secteur = Filiale::findOrFail($id);
            $secteur->delete();
            DB::commit();
            return response()->json(['success' => 'Secteur d\'activité supprimé avec succès.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la suppression du secteur d\'activité.'], 500);
        }
    }

    public function edit($id)
    {
        try {
            $filiale = Filiale::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Filiale trouvé',
                'data' => $filiale
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération de la Filiale.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'denomination' => 'required|string|max:255',
            'site' => 'nullable|string|max:255',
            'sigle_commercial' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'nullable|string|max:10',
            'fixe' => 'nullable|string|max:10',
            'date_creation' => 'required|date',
            'capital' => 'required|numeric',
            'nom_du_dg' => 'required|string|max:255',
            'imgDirecteur' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'secteur' => 'required|integer',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ];

        // Valider les données de la requête
        $validator = Validator::make($request->all(), $rules);

        // Vérifier si la validation échoue
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();
        try {
            $filiale = Filiale::findOrFail($id);

            // Sauvegarde des fichiers image
            if ($request->hasFile('imgDirecteur')) {
                $imgDirecteurPath = $request->file('imgDirecteur')->store('images', 'public');
            } else {
                $imgDirecteurPath = $filiale->photo_dg;
            }

            if ($request->hasFile('logo')) {
                $logoPath = $request->file('logo')->store('images', 'public');
            } else {
                $logoPath = $filiale->logo_path;
            }

            $filiale->update([
                'site_web' => $request->site,
                'denomination' => $request->denomination,
                'sigle_commercial' => $request->sigle_commercial,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'fix' => $request->fixe,
                'date_creation' => $request->date_creation,
                'capital_social' => $request->capital,
                'nom_dg' => $request->nom_du_dg,
                'photo_dg' => $imgDirecteurPath,
                'logo_path' => $logoPath,
                'secteur_id' => $request->secteur,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);

            DB::commit();

            // Retourner une réponse de succès
            return response()->json([
                'success' => true,
                'message' => 'Filiale modifiée avec succès',
            ], 200);
        } catch (\Throwable $th) {
            DB::rollback();

            // Enregistrer l'erreur dans les logs
            Log::error('Erreur lors de la modification de la filiale : ' . $th->getMessage());

            // Retourner une réponse d'erreur
            return response()->json([
                'message' => 'Erreur lors de la modification de la filiale',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function getCoordonne(Request $request)
    {
        $filiales = Filiale::get();
        return response()->json([
            'data' =>    FilialeCoordonneResource::collection($filiales),

        ], 201);
    }

    public function geInfo($id)
    {
        try {
            $filiale = Filiale::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Filiale trouvé',
                'data' => $filiale
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération de la Filiale.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
