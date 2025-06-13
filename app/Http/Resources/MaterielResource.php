<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaterielResource extends JsonResource
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
            'intitule' => $this->titre,
            'etat' => '' . $this->etat  ,
            'filiale' => $this->filiale ? $this->filiale->sigle_commercial : null,
            'img' =>   $this->img_path

        ];
    }
}