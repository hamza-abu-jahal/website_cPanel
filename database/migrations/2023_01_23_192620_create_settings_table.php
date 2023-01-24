<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('website_logo');
            $table->string('address');
            $table->string('address-icon');
            $table->string('contact_phone');
            $table->string('contact_email');
            $table->string('contact_icon');
            $table->string('service_title');
            $table->string('service_description');
            $table->time('work_from');
            $table->time('work_to');
            $table->time('work_icon');
            $table->string('blog_title');
            $table->string('blog_description');
            $table->string('contact_us_title');
            $table->string('contact_us_subtitle');
            $table->string('contact_us_description');
            $table->string('footer_title');
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
        Schema::dropIfExists('settings');
    }
};
