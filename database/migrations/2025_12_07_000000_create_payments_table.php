<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('contenu_id');
            $table->string('transaction_id')->unique()->nullable(); // ID de transaction FedaPay
            $table->string('feda_customer_id')->nullable(); // ID client FedaPay
            $table->decimal('amount', 10, 2); // Montant en FCFA
            $table->string('currency', 3)->default('XOF'); // Devise
            $table->enum('status', ['pending', 'approved', 'failed', 'cancelled'])->default('pending');
            $table->string('payment_method')->nullable(); // Méthode de paiement (mobile_money, card, etc.)
            $table->text('description')->nullable();
            $table->timestamp('paid_at')->nullable(); // Date de paiement effectif
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('contenu_id')->references('id')->on('contenus')->cascadeOnDelete();

            // Index pour améliorer les performances
            $table->index('user_id');
            $table->index('contenu_id');
            $table->index('status');
            $table->index('transaction_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

