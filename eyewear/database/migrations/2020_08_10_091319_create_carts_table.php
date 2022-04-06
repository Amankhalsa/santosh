<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cart_parent_id')->default(0);
            $table->unsignedBigInteger('product_id')->nullable();
            $table->string('product_name')->nullable();
            $table->unsignedBigInteger('addon_id')->nullable();
            $table->string('addon_name')->nullable();
            $table->unsignedInteger('quantity');
            $table->float('price');
            $table->enum('cart_type',['Product','Addon']);
            $table->string('user_email')->nullable();
            $table->string('session_id');

           
            $table->foreign('addon_id')->references('id')->on('addons')->onDelete('cascade');
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
        Schema::create('carts', function (Blueprint $table) {
           $table->dropForeign('addon_id');
        });
        Schema::dropIfExists('carts');
    }
}
