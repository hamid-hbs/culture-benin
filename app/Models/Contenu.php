<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Region;
use App\Models\Langue;
use App\Models\User;
use App\Models\Media;
use App\Models\Commentaire;

class Contenu extends Model
{
    //
protected $fillable = [
        'titre',
        'texte',
        'date_creation',
        'statut',
        'parent_id',
        'date_validation',
        'id_region',
        'id_langue',
        'id_moderateur',
        'id_type_contenu',
        'id_auteur',
    ];

    protected $casts = [
        'date_creation' => 'datetime',
        'date_validation' => 'datetime',
    ];
    

    // Relation vers la région
    public function region()
    {
        return $this->belongsTo(Region::class, 'id_region');
    }

    // Relation vers la langue
    public function langue()
    {
        return $this->belongsTo(Langue::class, 'id_langue');
    }

    // Contenu → Modérateur
    public function moderateur()
    {
        return $this->belongsTo(User::class, 'id_moderateur');
    }

    // Relation vers TypeContenu
    public function typecontenu()
    {
        return $this->belongsTo(TypeContenu::class, 'id_type_contenu');
    }

    // AUTEUR
    public function auteur()
    {
        return $this->belongsTo(User::class, 'id_auteur');
    }

    // Sous-contenus (un contenu peut avoir des enfants)
    public function enfants()
    {
        return $this->hasMany(Contenu::class, 'parent_id');
    }

    // Contenu parent
    public function parent()
    {
        return $this->belongsTo(Contenu::class, 'parent_id');
    }

    // Medias liés au contenu
     public function media()
    {
        return $this->hasOne(Media::class, 'id_contenu');
    }

    // Vérifie si le contenu a un média
    public function hasMedia()
    {
        return $this->media()->exists();
    }

    // Vérifie si c'est une image
    public function hasImage()
    {
        if (!$this->media) return false;
        
        $typeMedia = strtolower($this->media->typemedia->nom ?? '');
        return str_contains($typeMedia, 'image') || str_contains($typeMedia, 'photo');
    }

    // Vérifie si c'est une vidéo
    public function hasVideo()
    {
        if (!$this->media) return false;
        
        $typeMedia = strtolower($this->media->typemedia->nom ?? '');
        return str_contains($typeMedia, 'vidéo') || str_contains($typeMedia, 'video');
    }
    // Commentaires liés au contenu
    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'id_contenu');        

}

    
}