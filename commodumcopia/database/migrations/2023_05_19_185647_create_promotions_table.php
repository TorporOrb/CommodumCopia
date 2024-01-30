<?php

/*
titel: Create Promotions Table
beschrijving: Dit script schrijft de promotions tabel naar de database.
auteur: Pascal Thomasse Mol
versie: 1
aanmaakdatum: 19 jun 2023
laatste wijzigingsdatum: 19 jun 2023
*/

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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('header');
            $table->string('sub_header');
            $table->text('text');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
