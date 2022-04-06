<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ManagePageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('page_name');
            $table->string('page_link');
            $table->text('page_content')->nullable();
            $table->enum('page_status', ['Active','Inactive']);
            $table->enum('set_for_header', ['Yes','No']);
            $table->enum('set_for_footer', ['Yes','No']);
            $table->string('page_image');
            $table->Integer('page_order_by');
            $table->string('page_meta_title',200)->nullable();
            $table->string('page_meta_keywords',250)->nullable();
            $table->string('page_meta_description',250)->nullable();
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
        Schema::dropIfExists('manage_pages');
    }
}
