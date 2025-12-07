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
    Schema::create('parler', function (Blueprint $table) {
        $table->unsignedBigInteger('id_region');
        $table->unsignedBigInteger('id_langue');

        $table->primary(['id_region', 'id_langue']);

        $table->foreign('id_region')->references('id')->on('regions')->cascadeOnDelete();
        $table->foreign('id_langue')->references('id')->on('langues')->cascadeOnDelete();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parler');
    }
};
