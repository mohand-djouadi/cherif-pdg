<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Filiale;
use App\Models\Project;
use App\Models\ImageProject;
use App\Models\SecteurActivite;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Resources\ProjectListeResource;
use App\Http\Resources\ProjectEditResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ProjectCardResource;


class ProjectController extends Controller
{
    //

    public function index(Request $request)
    {

        $filiales = Filiale::get();
        return  view('pages/admin/project/admine_project', compact('filiales'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $validator = Validator::make($request->all(), [
                'intitule' => 'required|string|max:255',
                'maitre_ouvrage' => 'required|string|max:255',
                'montant' => 'required|numeric',
                // 'date_debut' => 'required|date',
                // 'date_fin' => 'required|date|after_or_equal:date_debut',
                'duree' => 'required|string',
                'localisation' => 'required|string|max:255',
                'filiale' => 'required',
                'participant' => 'required',
                'file.*' => 'nullable|array|min:1',
                'file.*' => 'nullable|file|mimes:jpg,jpeg,png',

            ]);
            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }

            $project = Project::create([
                'intitule' => $request->intitule,
                'maitre_ouvrage' =>  $request->maitre_ouvrage,
                'montant' => $request->montant,
                // 'date_debut' =>   $request->date_debut,
                // 'date_fin' =>   $request->date_fin,
                'duree'  =>$request->duree,
                'localisation' =>  $request->localisation,
                'id_filiale' =>  $request->filiale,
                'participation' =>  $request->participant,
            ]);

            if ($project) {
                // Traitement des fichiers
                if ($request->hasFile('file')) {

                    foreach ($request->file('file') as   $index => $file) {
                        $img_path = $file->store('projets_images', 'files');

                        ImageProject::create([
                            'path' => 'files/' . $img_path,
                            'id_project' =>   $project->id,
                            'img_ouverture' => $index === 0  ? true : false
                        ]);
                    }
                }
            }

            DB::commit();

            return response()->json(['success' => 'Projet ajouté avec succès.'], 200);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json(['error' => 'Erreur lors du sauvgarde :' . $th->getMessage()], 500);
        }
    }

    public function get(Request $request)
    {
        $projects = Project::orderBy('created_at', 'desc')->get();

        return response()->json(['data' =>  ProjectListeResource::collection($projects)], 200);
    }


    public function edit($id)
    {
        try {
            $projet = Project::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Projet trouvé',
                'data' => new ProjectEditResource($projet)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des données.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $projet = Project::findOrFail($id);
            $images = ImageProject::where('id_project', $id)->get();

            foreach ($images  as    $index  =>  $img) {
                Storage::delete($img->path);
                $img->delete();
            }


            $projet->delete();
            DB::commit();
            return response()->json(['success' => 'Projet supprimé avec succès.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la suppression du projet.'], 500);
        }
    }

    public function deleteImg($id)
    {
        DB::beginTransaction();
        try {
            $img = ImageProject::where('id', $id)->first();

            if ($img->img_ouverture === 1) {
                return response()->json(['error' => 'Vous ne pouvez pas supprimer l\'image de couverture.'], 409);
            } else {

                Storage::delete($img->path);
                $img->delete();
                DB::commit();
                return response()->json(['success' => 'Image s supprimé avec succès.']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la suppression de l\'image.'], 500);
        }
    }



    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {

            $validator = Validator::make($request->all(), [
                'intitule' => 'required|string|max:255',
                'maitre_ouvrage' => 'required|string|max:255',
                'montant' => 'required|numeric',
                // 'date_debut' => 'required|date',
                // 'date_fin' => 'required|date|after_or_equal:date_debut',
                'duree' => 'required|string',
                'localisation' => 'required|string|max:255',
                'filiale' => 'required',
                'img_ouverture' => 'required',
                'participant' => 'required',
                'file.*' => 'nullable|array|min:1',
                'file.*' => 'nullable|file|mimes:jpg,jpeg,png',

            ]);
            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }


            $project = Project::findOrFail($id);

            $project->update([
                'intitule' => $request->intitule,
                'maitre_ouvrage' =>  $request->maitre_ouvrage,
                'montant' => $request->montant,
                // 'date_debut' =>   $request->date_debut,
                // 'date_fin' =>   $request->date_fin,
                'duree' =>   $request->duree,
                'localisation' =>  $request->localisation,
                'id_filiale' =>  $request->filiale,
                'participation' =>  $request->participant,
            ]);

            if ($project) {

                // Traitement de la nouvelle image de couverture
                ImageProject::where('id_project', $project->id)->update(['img_ouverture' => false]);
                ImageProject::where('id', $request->img_ouverture)->update(['img_ouverture' => true]);

                // Traitement des nouvelles images
                if ($request->hasFile('file')) {

                    foreach ($request->file('file') as   $index => $file) {
                        $img_path = $file->store('projets_images', 'files');

                        ImageProject::create([
                            'path' => 'files/' . $img_path,
                            'id_project' =>   $project->id,
                            'img_ouverture' => false
                        ]);
                    }
                }
            }



            DB::commit();

            return response()->json(['success' => 'Projet ajouté avec succès.'], 200);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json(['error' => 'Erreur lors du sauvgarde :' . $th->getMessage()], 500);
        }
    }

    public function nosPrpjets(Request $request)
    {

        $secteurs = SecteurActivite::with('filiales.projets')->get();
        return view('pages.projets', compact('secteurs'));
    }


    public function getProjectDetail($id)
    {
        $projet = Project::with(['filiale.secteur', 'images'])->findOrFail($id);

        return view('pages.detail_project', compact('projet'));
    }
}
