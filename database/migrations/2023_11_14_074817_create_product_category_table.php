<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_category', function (Blueprint $table) {
            $table->id();
            $table->string('product_category');
            $table->integer('product_id');
            $table->string('product_name');
            $table->string('product_type');
            $table->integer('qty');
            $table->integer('show_online');
            $table->integer('tax');
            $table->integer('purchase_price');
            $table->boolean('isSelected');
            $table->integer('selectedQty');
            $table->integer('totalPrice');
            $table->integer('totalTax');
            $table->integer('totalDiscount');
            $table->integer('netAmount');
            $table->string('unit');
            $table->string('url');
            $table->integer('unitPrice');
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
        Schema::dropIfExists('product_category');
    }
}
