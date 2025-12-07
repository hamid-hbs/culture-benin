<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    //
    protected $fillable = ['nom'];

    // Relation vers les utilisateurs ayant ce rôle
    public function users()
    {
        return $this->hasMany(User::class, 'id_role');
    }
}