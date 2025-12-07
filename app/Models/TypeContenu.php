<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Contenu;

class TypeContenu extends Model
{
    //
    protected $table = 'type_contenus';
    
    protected $fillable = ['nom'];
    // Relation vers les contenus
    public function contenus()
    {
        return $this->hasMany(Contenu::class, 'id_type_contenu');
    }
    

}
