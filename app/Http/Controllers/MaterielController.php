<?php

namespace App\Http\Controllers;

use App\Http\Resources\MaterielResource;
use App\Models\Filiale;
use App\Models\Materiel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MaterielController extends Controller
{
    //
    public function index(Request $request)
    {

        $filiales = Filiale::get();
        return  view('pages/admin/materiel/admin_materiel', compact('filiales'));
    }


    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $validator = Validator::make($request->all(), [
                'intitule' => 'required|string|max:255',
                'filiale' => 'required',
                'img' => 'nullable|file|mimes:jpg,jpeg,png',

            ]);
            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }

            if ($request->hasFile('img')){
                $img_path = $request->file('img')->store('materiels_images', 'files');
            }else{
                $img_path = ''  ;
            }

            $materiel = Materiel::create([
                'titre' => $request->intitule,
                'id_filiale' =>  $request->filiale,
                'img_path' =>  'files/' . $img_path,
                'etat'=> false
            ]);


            DB::commit();

            return response()->json(['success' => 'Materiel ajouté avec succès.'], 200);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json(['error' => 'Erreur lors du sauvgarde :' . $th->getMessage()], 500);
        }
    }


    public function get(Request $request)
    {
        $materiel = $materiel = Materiel::with('filiale')->orderBy('created_at', 'desc')->get();

        return response()->json( ['data' => MaterielResource::collection($materiel) ], 200);
    }



    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $materiel = Materiel::findOrFail($id);
            if ($materiel->img_path && Storage::exists($materiel->img_path)) {
                Storage::delete($materiel->img_path);
            }
             // Suppression du matériel
             $materiel->delete();
            DB::commit();
            return response()->json(['success' => 'Materiel supprimé avec succès.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la suppression du Materiel.'], 500);
        }
    }

    public function edit($id)
    {
        try {
            $materiel = Materiel::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Projet trouvé',
                'data' => $materiel
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des données.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {

            $validator = Validator::make($request->all(), [
                'intitule' => 'required|string|max:255',
                'filiale' => 'required',
                'img' => 'nullable|file|mimes:jpg,jpeg,png',

            ]);
            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }


            $materiel = Materiel::findOrFail($id);
            $materiel->update([
                'titre' => $request->intitule,
                'id_filiale' =>  $request->filiale,
                'etat' => false
            ]);
            if ( $materiel && $request->hasFile('img')){
                $img_path = $request->file('img')->store('materiels_images', 'files');
                $materiel->img_path =  'files/' . $img_path;
                $materiel->save();
            }

            DB::commit();

            return response()->json(['success' => 'Materiel ajouté avec succès.'], 200);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json(['error' => 'Erreur lors du sauvgarde :' . $th->getMessage()], 500);
        }
    }

    public function publie($id)
    {
        try {
            $materiel = Materiel::findOrFail($id);
            $materiel->etat =true ;
            $materiel->update();
            return response()->json([
                'success' => true,
                'message' => 'Materiel publié ',

            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des données.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function notreMateriel(Request $request)
    {

        $materiels = Materiel::get();
        return view('pages.notre_materiel', compact('materiels'));
    }


}