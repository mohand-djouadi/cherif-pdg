<?php

namespace App\Http\Controllers;

use App\Models\ImageCarrousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CarrouselController extends Controller
{
    //



    public function index(Request $request)
    {
        $images  = ImageCarrousel::get();

        return  view('pages/admin/carrousel/admine_carrousel', compact('images'));
    }

    public function store(Request $request)
    {

        DB::beginTransaction();
        try {
            $imageCount = ImageCarrousel::where('image_principale', true)->count();
            $image_principale = $imageCount > 0;

            if ($request->hasFile('file')) {

                foreach ($request->file('file') as   $index => $file) {
                    $img_path = $file->store('carrousel_images', 'files');
                if($index == 0  &&  $image_principale === false ){
                    ImageCarrousel::create([
                        'img_path' => 'files/' . $img_path,
                        'image_principale' => true
                    ]);
                 }else{
                    ImageCarrousel::create([
                        'img_path' => 'files/' . $img_path,
                        'image_principale' => false
                    ]);
                 }

                }
            }

            DB::commit();

            return response()->json(['success' => 'Images ajoutées avec succès.'], 200);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json(['error' => 'Erreur lors de l\'upload.  :' . $th->getMessage()], 500);
        }
    }

    public function get(Request $request)
    {
        $images  = ImageCarrousel::get();

        return response()->json( ['data' =>  $images  ], 200);
    }

    public function deleteImg($id)
    {
        DB::beginTransaction();
        try {
            $img = ImageCarrousel::findOrFail($id);

            // Vérification si le chemin de l'image n'est pas vide avant de supprimer
            if ($img->img_path) {
                Storage::delete($img->img_path);
            }

           if($img->image_principale){
                  $last_img = ImageCarrousel::first();
                  $last_img->image_principale =  true ;
                  $last_img->save();
           }

            $img->delete();
            DB::commit();

            return response()->json(['success' => 'Image supprimée avec succès.']);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => 'Erreur lors de la suppression de l\'image.'], 500);
        }
    }


    public function updateImgPrincipale($id)
    {
        DB::beginTransaction();
        try {

            $old_image = ImageCarrousel::where('image_principale',true)->first();
            $old_image->image_principale = false ;
            $old_image->save();

            $img = ImageCarrousel::findOrFail($id);
            $img->image_principale = true ;
            $img->save();
            DB::commit();

            return response()->json(['success' => 'Image principale modifiée avec succès.']);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => 'Erreur lors de la modification de l\'image principale.'], 500);
        }
    }
}
