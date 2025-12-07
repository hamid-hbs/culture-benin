<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('commentaires', function (Blueprint $table) {
        $table->id('id');
        $table->longText('texte');
        $table->integer('note')->default(0);
        $table->dateTime('date')->default(now());

        // FK
        $table->unsignedBigInteger('id_user');
        $table->unsignedBigInteger('id_contenu');

        $table->foreign('id_user')->references('id')->on('users')->cascadeOnDelete();
        $table->foreign('id_contenu')->references('id')->on('contenus')->cascadeOnDelete();

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commentaires');
    }
};
