<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Contenu;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'contenu_id',
        'transaction_id',
        'feda_customer_id',
        'amount',
        'currency',
        'status',
        'payment_method',
        'description',
        'paid_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contenu()
    {
        return $this->belongsTo(Contenu::class);
    }

    // Vérifier si le paiement est approuvé
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    // Vérifier si le paiement est en attente
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    // Vérifier si le paiement a échoué
    public function isFailed(): bool
    {
        return $this->status === 'failed';
    }
}
