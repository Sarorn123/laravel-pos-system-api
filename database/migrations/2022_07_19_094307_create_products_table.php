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
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->bigInteger('category_id');
            $table->float('in_stock_price', 0, 0);
            $table->float('sell_price', 0, 0);
            $table->bigInteger('in_stock');
            $table->date('in_stock_date')->nullable();
            $table->date('out_stock_date')->nullable();
            $table->string('description', 500)->nullable();
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
