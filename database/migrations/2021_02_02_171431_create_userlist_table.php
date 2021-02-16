<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserlistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('userlist', function (Blueprint $table) {
            $table->increments('id');
            // $table->string('customer');
            $table->date('purchasedon');
            $table->integer('customerid');
            $table->integer('couponid');
            // $table->string('shipto');
            // $table->string('baseprice');
            // $table->string('purchaseprice');
            // $table->enum('status',['onhold','pending','closed'])->default('onhold');
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
         Schema::dropIfExists('userlist');
    }
}
