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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->text('banner');
            $table->string('shop_name')->nullable();
            $table->string('phone');
            $table->string('email');
            $table->text('address');
            $table->text('description');
            $table->text('fb_link')->nullable();
            $table->text('tw_link')->nullable();
            $table->text('insta_link')->nullable();
            $table->integer('user_id');
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('vendors');
    }
};
