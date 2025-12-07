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
    Schema::create('contenus', function (Blueprint $table) {
        $table->id();
        $table->string('titre');
        $table->longText('texte');
        $table->dateTime('date_creation')->default(now());
        $table->string('statut')->default('en_attente');
        $table->unsignedBigInteger('parent_id')->nullable();
        $table->dateTime('date_validation')->nullable();

        // FK
        $table->unsignedBigInteger('id_region')->nullable();
        $table->unsignedBigInteger('id_langue')->nullable();
        $table->unsignedBigInteger('id_moderateur')->nullable();
        $table->unsignedBigInteger('id_type_contenu');
        $table->unsignedBigInteger('id_auteur');

        $table->foreign('id_region')->references('id')->on('regions')->nullOnDelete();
        $table->foreign('id_langue')->references('id')->on('langues')->nullOnDelete();
        $table->foreign('id_moderateur')->references('id')->on('users')->nullOnDelete();
        $table->foreign('id_type_contenu')->references('id')->on('type_contenus')->cascadeOnDelete();
        $table->foreign('id_auteur')->references('id')->on('users')->cascadeOnDelete();

        $table->foreign('parent_id')->references('id')->on('contenus')->nullOnDelete();

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contenus');
    }
};
