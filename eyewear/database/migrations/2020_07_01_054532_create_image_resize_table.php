<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageResizeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_resizes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('resize_section_name',150);
            $table->unsignedBigInteger('resize_width');
            $table->unsignedBigInteger('resize_height');
            $table->enum('resize_status', ['Active','Inactive']);
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
        Schema::dropIfExists('image_resizes');
    }
}
