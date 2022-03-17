<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('author_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name');
            $table->longText('bio');

            $table->unique(['author_id', 'locale']);
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('author_translations');
    }
}
