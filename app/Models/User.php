<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use App\Models\Langue;
use App\Models\Contenu;
use App\Models\Commentaire;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'mot_de_passe',
        'sexe',
        'date_inscription',
        'date_naissance',
        'statut',
        'photo',
        'id_role',
        'id_langue',
        'two_factor_code',          // AJOUTÉ
        'two_factor_expires_at',    // AJOUTÉ
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'mot_de_passe',
        'remember_token',
        'two_factor_code',          // AJOUTÉ (caché dans les sérialisations)
    ];

    protected $attributes = [
        'id_role' => 3,
        'statut' => 'Actif',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'mot_de_passe' => 'hashed',
            'date_inscription' => 'datetime',
            'date_naissance' => 'date',
            'two_factor_expires_at' => 'datetime',  // AJOUTÉ
        ];
    }

    /**
     * Génère un code 2FA à 6 chiffres
     */
    public function generateTwoFactorCode()
    {
        $this->timestamps = false; // Empêche la mise à jour des timestamps
        $this->two_factor_code = rand(100000, 999999);
        $this->two_factor_expires_at = now()->addMinutes(10);
        $this->save();
    }

    /**
     * Réinitialise le code 2FA après utilisation
     */
     public function resetTwoFactorCode()
    {
        $this->timestamps = false;
        $this->two_factor_code = null;
        $this->two_factor_expires_at = null;
        $this->save();
    }

    // --- Relations ---
    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role');
    }

    public function langue()
    {
        return $this->belongsTo(Langue::class, 'id_langue');
    }

    // Contenus écrits par l'utilisateur (auteur)
    public function contenus()
    {
        return $this->hasMany(Contenu::class, 'id_auteur');
    }

    // Commentaires écrits par l'utilisateur
    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'id_user');
    }

    // Pour que Laravel Auth utilise le champ mot_de_passe au lieu de password
    public function getAuthPassword()
    {
        return $this->mot_de_passe;
    }

    public function isAdmin(): bool
    {
        return (int) $this->id_role === 4;
    }

    /**
     * Vérifie si le code 2FA est encore valide
     */
    public function isTwoFactorCodeValid(): bool
    {
        return $this->two_factor_code && 
               $this->two_factor_expires_at && 
               now()->lt($this->two_factor_expires_at);
    }
    
}