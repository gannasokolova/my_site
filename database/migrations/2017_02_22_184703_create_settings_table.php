<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('phone');
            $table->string('skype');
            $table->unsignedInteger('user_top_menu');
            $table->unsignedInteger('admin_top_menu');
            $table->unsignedInteger('admin_left_menu');
            $table->unsignedInteger('default_user_role');
            $table->unsignedInteger('admin_role');
            $table->enum('approve_comments', ['YES', 'NO']);
            $table->string('default_user_avatar');
            $table->string('default_page_header');
        });

        Schema::table('settings', function (Blueprint $table) {
            $table->foreign('user_top_menu')->references('id')->on('menus');
        });

        Schema::table('settings', function (Blueprint $table) {
            $table->foreign('admin_top_menu')->references('id')->on('menus');
        });

        Schema::table('settings', function (Blueprint $table) {
            $table->foreign('admin_left_menu')->references('id')->on('menus');
        });

        Schema::table('settings', function (Blueprint $table) {
            $table->foreign('default_user_role')->references('id')->on('roles');
        });

        Schema::table('settings', function (Blueprint $table) {
            $table->foreign('admin_role')->references('id')->on('roles');
        });

        Schema::table('settings', function (Blueprint $table) {
            $table->foreign('default_page_header')->references('id')->on('pages');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('settings');
    }
}
