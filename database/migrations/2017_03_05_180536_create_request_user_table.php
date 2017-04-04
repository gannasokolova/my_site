<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('price_id')->nullable();
            $table->timestamps();
        });

        Schema::table('request_user', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        }); Schema::table('request_user', function (Blueprint $table) {
            $table->foreign('price_id')->references('id')->on('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('request_user');
    }
}
