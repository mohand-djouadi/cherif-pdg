<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actualite extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'contenu',
        'nom_img',
        'path_img',
        'date_debut',
        'etat',
    ];

    protected $casts = [
        'etat' => 'boolean', // Assure que 'etat' est toujours un booléen
    ];
}
