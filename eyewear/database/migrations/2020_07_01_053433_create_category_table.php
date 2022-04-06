<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_parent_id')->default(0);
            $table->string('category_name');
            $table->string('category_code',100)->nullable();
            $table->string('category_slug_name');
            $table->string('category_image_name');
            $table->text('category_short_description')->nullable();
            $table->decimal('category_price', 8,2)->nullable();
            $table->string('category_bead_size',100)->nullable();
            $table->longText('category_description')->nullable();
            $table->string('category_meta_title',200)->nullable();
            $table->string('category_meta_description',300)->nullable();
            $table->string('category_meta_keywords',500)->nullable();
            $table->string('category_inner_banner',150)->nullable();
            $table->string('category_video_name',150)->nullable();
            $table->enum('category_type', ['cat','subcat','subsubcat','finalcat','product']);
            $table->enum('category_is_hot', ['Yes','No'])->default('No');
            $table->enum('category_is_featured', ['Yes','No'])->default('No');
            $table->enum('category_is_top', ['Yes','No'])->default('No');
            $table->enum('category_is_latest', ['Yes','No'])->default('No');
            $table->enum('category_for_home', ['Yes','No'])->default('No');
            $table->unsignedMediumInteger('category_order_by')->default(0);
            $table->enum('category_status', ['Active','Inactive']);
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
        Schema::dropIfExists('categories');
    }
}
