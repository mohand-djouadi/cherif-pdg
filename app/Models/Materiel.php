<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiel extends Model
{
    use HasFactory;

    protected $table = 'materiel';

    protected $fillable = [
        'id_filiale',
        'img_path',
        'titre',
        'etat',
    ];

    /**
     * Get the filiale that owns the materiel.
     */
    public function filiale()
    {
        return $this->belongsTo(Filiale::class, 'id_filiale');
    }
}
