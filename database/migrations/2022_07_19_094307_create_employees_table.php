<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('gender');
            $table->date('date_of_birth');
            $table->string('address', 500);
            $table->string('salary');
            $table->string('phone');
            $table->string('email');
            $table->string('image_url', 500)->nullable();
            $table->bigInteger('position_id')->nullable();
            $table->date('created_at')->nullable();
            $table->date('updated_at')->nullable();
            $table->bigInteger('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
