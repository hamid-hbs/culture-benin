<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TypeMedia;
use App\Models\Contenu;

class Media extends Model
{
    //
    protected $table = 'medias';
    protected $fillable = ['chemin', 'description', 'id_type_media', 'id_contenu'];


    // --- Relations ---
    public function typemedia()
    {
        return $this->belongsTo(TypeMedia::class, 'id_type_media');
}

    public function contenu()
    {
        return $this->belongsTo(Contenu::class, 'id_contenu');
    }
}