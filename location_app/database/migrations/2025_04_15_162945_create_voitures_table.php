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
        Schema::create('voitures', function (Blueprint $table) {
            $table->id();
            $table->string('marque', 100);
            $table->string('modele', 100);
            $table->year('annee');
            $table->decimal('prix_journalier', 10, 2);
            $table->enum('type_carburant', ['essence', 'diesel', 'électrique', 'hybride']);
            $table->enum('boite_vitesse', ['manuelle', 'automatique']);
            $table->boolean('disponible')->default(true);
            $table->string('photo_principale')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            // Index pour optimisation
            $table->index(['marque', 'modele']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voitures');
    }
};
