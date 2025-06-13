<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageProject extends Model
{
    use HasFactory;

    protected $table = 'images_project';

    protected $fillable = [
        'name', 'path', 'img_ouverture', 'id_project',
    ];

    // Relation vers le projet associé
    public function project()
    {
        return $this->belongsTo(Project::class, 'id_project');
    }
}
