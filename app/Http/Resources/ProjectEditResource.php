<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProjectImageResource;


class ProjectEditResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id ,
            'intitule' => $this->intitule,
            'maitre_ouvrage' => $this->maitre_ouvrage,
            'montant' => $this->montant,
            // 'date_debut' => Carbon::parse($this->date_debut)->toDateString() ,
            // 'date_fin' => Carbon::parse($this->date_fin)->toDateString() ,
            'duree' => $this->duree,
            'id_filiale' => $this->id_filiale,
            'participation' =>  $this->participation ,
            'images' => ProjectImageResource::collection( $this->images2()) ,
            'localisation' => $this->localisation

        ];
    }
}
