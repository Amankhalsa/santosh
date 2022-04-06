<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('admin_name',50);
            $table->string('email')->unique();
            $table->string('admin_alternate_email',100)->nullable();
            $table->string('password');
            $table->string('admin_mobile',20);
            $table->string('admin_phone',30)->nullable();
            $table->string('admin_roles');
            $table->string('admin_website_url',100)->nullable();
            $table->string('admin_company_name',150)->nullable();
            $table->string('admin_facebook_link',100)->nullable();
            $table->string('admin_instagram_link',100)->nullable();
            $table->string('admin_twitter_link',100)->nullable();
            $table->string('admin_linkedin_link',100)->nullable();
            $table->string('admin_pinterest_link',100)->nullable();
            $table->string('admin_youtube_link',100)->nullable();
            $table->string('admin_whatsapp_number',20)->nullable();
            $table->string('admin_favicon')->nullable();
            $table->string('admin_logo')->nullable();
            $table->enum('isAdmin', ['Yes','No'])->default('No');
            $table->text('admin_address')->nullable();
            $table->string('admin_city',100)->nullable();
            $table->string('admin_state',100)->nullable();
            $table->string('admin_country',100)->nullable();
            $table->string('admin_zip_code',15)->nullable();
            $table->text('admin_map')->nullable();
            $table->string('admin_fax',100)->nullable();
            $table->enum('admin_cat_thumb', ['Yes','No'])->default('No');
            $table->enum('admin_subcat_thumb', ['Yes','No'])->default('No');
            $table->enum('admin_finalcat_thumb', ['Yes','No'])->default('No');
            $table->enum('admin_product_thumb', ['Yes','No'])->default('No');
            $table->enum('admin_search_option', ['Yes','No'])->default('No');
            $table->unsignedTinyInteger('admin_category_level')->default(3);
            $table->enum('admin_backup_option', ['Yes','No'])->default('No');
            $table->enum('admin_backup_schedule', ['daily','weekly','monthly'])->default('No');
            $table->enum('admin_sitemap_option', ['Yes','No'])->default('No');
            $table->enum('admin_sitemap_schedule', ['daily','weekly','monthly'])->default('No');
            $table->enum('admin_meta_robots', ['Yes','No'])->nullable();
            $table->enum('admin_status', ['Active','Inactive'])->default('Inactive');
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
        Schema::dropIfExists('admins');
    }
}
