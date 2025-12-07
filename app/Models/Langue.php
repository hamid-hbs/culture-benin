<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Contenu;
use App\Models\User;

class Langue extends Model
{
    protected $fillable = ['nom','code','description'];

    // Relation vers les contenus
    public function contenus()
    {
        return $this->hasMany(Contenu::class, 'id_langue');
    }

    // Relation vers les utilisateurs
    public function users()
    {
        return $this->hasMany(User::class, 'id_langue');
    }   
}
