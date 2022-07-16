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
            $table->char('name');
            $table->bigInteger('gender');
            $table->date('date_of_birth');
            $table->char('address', 500);
            $table->char('salary');
            $table->char('phone');
            $table->char('email');
            $table->char('image_url', 500)->nullable();
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
