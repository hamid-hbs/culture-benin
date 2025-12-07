<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Contenu;

class Region extends Model
{
    protected $fillable = ['nom', 'description','population', 'superficie','localisation'];

    // Relation vers les contenus
    public function contenus()
    {
        return $this->hasMany(Contenu::class, 'id_region');
    }
}
