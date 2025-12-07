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
    Schema::create('medias', function (Blueprint $table) {
        $table->id('id');
        $table->string('chemin');
        $table->text('description')->nullable();

        // FK
        $table->unsignedBigInteger('id_contenu');
        $table->unsignedBigInteger('id_type_media');

        $table->foreign('id_contenu')->references('id')->on('contenus')->cascadeOnDelete();
        $table->foreign('id_type_media')->references('id')->on('type_medias')->cascadeOnDelete();

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medias');
    }
};
