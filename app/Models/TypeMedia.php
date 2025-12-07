<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Media;

class TypeMedia extends Model
{
    //
    protected $table = 'type_medias';
    
    protected $fillable = ['nom'];
    // Relation vers les médias
    public function medias()
    {
        return $this->hasMany(Media::class, 'id_type_media');
    }
}