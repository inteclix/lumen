<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->unique();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('password', 60);
            $table->string('tel')->nullable();
            $table->enum('role', ['user', 'admin']);
            $table->string('img1');
            $table->string('img2');
            $table->string('img3');
            $table->rememberToken();
            $table->timestamps();
            /*              $table->integer('student_id')->unsigned();
             *             $table->foreign('student_id')
                                ->references('id')->on('students');
             * */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
