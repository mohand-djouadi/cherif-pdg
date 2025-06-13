<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Filiale extends Model
{
    use HasFactory;

    protected $table = 'filiale';

    protected $fillable = [
       'secteur_id',
        'denomination',
        'affiliation',
        'sigle_commercial',
        'date_creation',
        'capital_social',
        'nom_dg',
        'photo_dg',
        'site_web',
        'logo_path',
        'email',
        'fix',
        'telephone',
        'longitude',
        'latitude'
    ];

    protected $casts = [
        'date_creation' => 'date',
        'capital_social' => 'decimal:2',
    ];


    public function secteur(): BelongsTo
    {
        return $this->belongsTo(SecteurActivite::class, 'secteur_id', 'id');
    }

    public function projets()
    {
        return $this->hasMany(Project::class,'id_filiale','id');
    }

}
