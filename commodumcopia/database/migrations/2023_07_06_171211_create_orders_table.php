<?php

/*
titel: Create Orders Table
beschrijving: Dit script schrijft de orders tabel naar de database.
auteur: Pascal Thomasse Mol
versie: 1
aanmaakdatum: 18 jul 2023
laatste wijzigingsdatum: 18 jul 2023
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->dateTime('order_date');
            $table->integer('total_products');
            $table->string('delivery_start_time');
            $table->string('delivery_end_time');
            $table->decimal('delivery_price', 8, 2);
            $table->string('delivery_address');
            $table->string('postal_code');
            $table->string('delivery_city');            
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
