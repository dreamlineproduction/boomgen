<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('logo');
            $table->string('title');
            $table->string('couponcode')->unique();
            $table->string('description', 10000);
            $table->string('percentage');
            $table->string('fixed');
            $table->string('amount');
            $table->string('expirydate');
            $table->enum('status', ['0', '1']);
            $table->string("selecteduser");
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
        Schema::dropIfExists('coupon');
    }
}
