<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_carts_products', function (Blueprint $table) {
            $table->unsignedBigInteger('id_cart');
            $table->unsignedBigInteger('id_product');
            $table->integer('quantity');
            $table->integer('subtotal');
            $table->primary(['id_cart', 'id_product']);

            $table->foreign('id_cart')->references('id_cart')->on('carts');

            $table->foreign('id_product')->references('id_product')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_carts_products');
    }
};
