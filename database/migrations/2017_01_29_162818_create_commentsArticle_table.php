<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commentsArticle', function (Blueprint $table) {
            $table->increments('id', 2);
            $table->unsignedInteger('article_id'); //здесь будет хранится id статьи
            $table->text('content');
            $table->string('author');
            $table->enum('public', ['YES', 'NO']);
            $table->string('parent_id');
            $table->string('path', 28);
            $table->integer('level');
            $table->timestamps();
        });
        Schema::table('commentsArticle', function (Blueprint $table) {
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('commentsArticle');
    }
}
