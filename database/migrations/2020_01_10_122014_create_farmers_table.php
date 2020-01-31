<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('number');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('birth_day');
            $table->string('birth_place');
            $table->string('address');
            $table->string('phone');
            $table->string('job');
            $table->string('engaged');
            $table->enum('sex', ['home', 'woman']);
            $table->enum('have_card', ['yes', 'no']);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('farmers');
    }
}
