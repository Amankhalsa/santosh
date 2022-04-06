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
            $table->string('name',50);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('provider')->nullable();
            $table->string('provider_id');
            $table->string('mobile',15)->nullable();
            $table->string('dial_code',30)->nullable();
            $table->text('address')->nullable();
            $table->string('city',100)->nullable(); 
            $table->string('state',100)->nullable();
            $table->string('pincode',50)->nullable();
            $table->string('country',100)->nullable();
            $table->string('landmark',200)->nullable(); 
            $table->enum('status',['Active','Inactive'])->default('Active');              
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
