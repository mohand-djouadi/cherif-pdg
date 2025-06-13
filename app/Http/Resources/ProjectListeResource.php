<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProjectListeResource extends JsonResource
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
            'date' => '' . $this->duree  ,
            'filiale' => $this->filiale->sigle_commercial,
            'img' =>   $this->imgCouverture()

        ];
    }
}
