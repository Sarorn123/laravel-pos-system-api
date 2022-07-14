<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->char('first_name')->nullable();
            $table->char('last_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->bigInteger('gender')->nullable();
            $table->bigInteger('position_id')->nullable()->default(1);
            $table->bigInteger('salary')->nullable();
            $table->char('image', 500)->nullable();
            $table->bigInteger('phone_number')->nullable();
            $table->char('address', 500)->nullable();
            $table->date('created_at')->nullable();
            $table->date('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_detail');
    }
}
