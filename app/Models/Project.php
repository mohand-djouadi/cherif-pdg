<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'intitule',
        'maitre_ouvrage',
        'montant',
        'date_debut',
        'date_fin',
        'localisation',
        'id_filiale',
        'participation',
        'duree'
    ];

    protected $casts = [
        'montant' => 'decimal:2',
        'date_debut' => 'date',
        'date_fin' => 'date',
    ];

    public function filiale()
    {
        return $this->belongsTo(Filiale::class, 'id_filiale');
    }

    public function imgCouverture()
    {
                $img = $this->images()->where('img_ouverture', true)->first();
                return $img ? $img->path : '';
    }

    public function imgCouverture2(): Attribute
    {
        return Attribute::make(
            get: function () {
                $img = $this->images()->where('img_ouverture', true)->first();
                return $img ? $img->path : '';
            }
        );
    }


    public function images()
    {
        return $this->hasMany(ImageProject::class, 'id_project');
    }

    public function images2()
    {
        return ImageProject::where('id_project',$this->id)->get();
    }
}