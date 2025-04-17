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
            Schema::create('reservations', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('voiture_id')->constrained()->onDelete('cascade');
                $table->date('date_debut');
                $table->date('date_fin');
                $table->decimal('prix_total', 10, 2);
                $table->enum('statut', ['en_attente', 'confirmee', 'annulee'])->default('en_attente');
                $table->timestamps();
            });
        }
    
        public function down()
        {
            Schema::dropIfExists('reservations');
        }

};
