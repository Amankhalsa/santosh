<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_code')->nullable();
            $table->unsignedBigInteger('order_user_id');
            $table->float('order_amount');
            $table->float('order_tax')->nullable();
            $table->float('order_net_amount');
            $table->enum('order_payment_method',['COD','Online']);
            $table->enum('order_delivery_status',['Pending','Delivered','Cancel']);

            $table->foreign('order_user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::create('orders', function (Blueprint $table) {
           $table->dropForeign('order_user_id');
        });
        Schema::dropIfExists('orders');
    }
}
