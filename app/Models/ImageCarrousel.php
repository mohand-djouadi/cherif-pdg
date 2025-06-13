<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageCarrousel extends Model
{
    use HasFactory;

     // Nom de la table associée
     protected $table = 'images_carrousel';

     // Les attributs qui peuvent être assignés en masse
     protected $fillable = [
         'img_path',
         'etat',
         'image_principale'
     ];
}
