<?php

/*
titel: Create Products Table
beschrijving: Dit script schrijft de products tabel naar de database.
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
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->text('body');
        $table->decimal('price', 8, 2);
        $table->unsignedBigInteger('category_id');
        $table->unsignedBigInteger('sub_category_id');
        $table->unsignedBigInteger('discount_id')->nullable();
        $table->foreign('discount_id')->references('id')->on('discounts');
        $table->string('image')->nullable();
        $table->timestamps();

        $table->foreign('category_id')->references('id')->on('categories');
        $table->foreign('sub_category_id')->references('id')->on('sub_categories');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};