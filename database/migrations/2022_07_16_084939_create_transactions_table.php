<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id');
            $table->bigInteger('customer_id');
            $table->bigInteger('quantity');
            $table->date('date');
            $table->float('price', 0, 0);
            $table->bigInteger('status')->nullable()->default(0);
            $table->char('description', 500)->nullable();
            $table->char('year')->nullable();
            $table->char('month_year')->nullable();
            $table->date('created_at')->nullable();
            $table->date('updated_at')->nullable();
            $table->float('discount', 0, 0)->nullable()->default(0);
            $table->char('transaction_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
