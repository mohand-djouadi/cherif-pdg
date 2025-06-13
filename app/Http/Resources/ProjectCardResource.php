<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectCardResource extends JsonResource
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
            'image' =>  $this->imgCouvertur2 ,
            'localisation' => $this->localisation ,
           'filiale' => $this->filiale ? $this->filiale->sigle_commercial : 'Aucune filiale'



        ];

    }
}