<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('voitures', function (Blueprint $table) {
            $table->id();
            $table->string('marque');
            $table->string('modele');
            $table->integer('annee');
            $table->decimal('prix_journalier', 8, 2); // Ex: 45.50 €
            $table->string('carburant'); // Essence, Diesel, Électrique...
            $table->string('photo')->nullable(); // Chemin vers l'image
            $table->boolean('disponible')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('voitures');
    }
};