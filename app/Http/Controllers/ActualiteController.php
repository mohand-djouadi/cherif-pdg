<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actualite;
use App\Models\Project;
use App\Models\ImageCarrousel;
use App\Http\Resources\ProjectCardResource;

class ActualiteController extends Controller
{
    public function accueil(Request $request)
    {
        $actualites = Actualite::where('etat', 1)
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();

        $projects = Project::with('filiale')
            ->whereHas('filiale', function ($query) {
                $query->whereIn('sigle_commercial', ['MEDITRAM', 'ALDIPH', 'SAPTA', 'EPTP ALGER']);
            })
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();

        $pro = ProjectCardResource::collection($projects);

        $images = ImageCarrousel::get();

        return view('pages.accueil', compact('actualites', 'pro', 'images'));
    }
}