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
            $table->increments('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('image');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phonenumber');
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('state');
            $table->string('zip');
            $table->string('type');
            $table->enum('status', ['0', '1']);
            $table->string('otp');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
