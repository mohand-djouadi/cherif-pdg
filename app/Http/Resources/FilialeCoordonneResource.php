<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class FilialeCoordonneResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'logo' => Storage::url($this->logo_path),
            'secteur' => $this->secteur->titre,
            'date_creation' => Carbon::parse($this->date_creation)->toDateString(),
            'sigle_commercial'=> $this->sigle_commercial ,
            'longitude' =>floatval($this->longitude) ,
            'latitude' => floatval($this->latitude) ,
            'intitule_proj' => $this->sigle_commercial

        ];
    }
}
