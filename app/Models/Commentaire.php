<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Contenu;

class Commentaire extends Model
{
    //
    protected $attributes = [
    'note'=> 0,
    ];

    protected $fillable = [
        'texte',
        'note',
        'date',
        'id_user',
        'id_contenu'
    ];

protected $casts = [
    'date' => 'datetime',
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
];

    // Commentaire → Utilisateur
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Commentaire → Contenu
    public function contenu()
    {
        return $this->belongsTo(Contenu::class, 'id_contenu');
    }
}
