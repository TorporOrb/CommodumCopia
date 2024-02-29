<?php

/*
titel: Create Order Products Table
beschrijving: Dit script schrijft de order products tabel naar de database.
auteur: Pascal Thomasse Mol
versie: 2
aanmaakdatum: 14 jul 2023
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
    public function up()
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('discount_id')->nullable();
            $table->integer('quantity');
            $table->decimal('set_price', 8, 2); 
            $table->timestamps();    
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('discount_id')->references('id')->on('discounts');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('order_product');
    }
};
