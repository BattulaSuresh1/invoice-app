<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('avg_purchase_price');
            $table->string('barcode_id');
            $table->text('description');
            $table->integer('discount');
            $table->integer('free_qty');
            $table->string('hsn_code');
            $table->string('image');
            $table->boolean('is_price_with_tax');
            $table->integer('price_with_tax');
            $table->integer('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
