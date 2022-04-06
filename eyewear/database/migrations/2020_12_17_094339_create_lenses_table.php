<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lens_image_name');
            $table->string('name');
            $table->string('index',20);
            $table->string('brand');
            $table->enum('type',['EYEGLASSES','SUNGLASSES']);
            $table->text('description');
            $table->enum('blue_light_protection',['Yes','No']);
            $table->enum('anti_reflection',['Yes','No']);
            $table->enum('scratch_resistant',['Yes','No']);
            $table->enum('super_hydrophobic_and_smudge_free',['Yes','No']);
            $table->enum('uv_protection',['Yes','No']);
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
        Schema::dropIfExists('lenses');
    }
}
