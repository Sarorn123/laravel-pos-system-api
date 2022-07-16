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
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
            $table->bigInteger('category_id')->nullable();
            $table->bigInteger('in_stock_price')->nullable();
            $table->bigInteger('sell_price')->nullable();
            $table->bigInteger('in_stock')->nullable();
            $table->date('in_stock_date')->nullable();
            $table->date('out_stock_date')->nullable();
            $table->text('description')->nullable();
            $table->float('discount', 0, 0)->nullable()->default(0);
            $table->bigInteger('supplier_id')->nullable();
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
