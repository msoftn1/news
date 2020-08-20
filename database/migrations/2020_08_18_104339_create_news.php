<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateNews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('source_id')->nullable(false);
            $table->string('author')->nullable(true)->index();
            $table->string('title', 1000)->nullable(false)->index();
            $table->text('description')->nullable(true);
            $table->text('url')->nullable(true);
            $table->text('url_to_image')->nullable(true);
            $table->text('image')->nullable(true);
            $table->dateTimeTz('published_at')->nullable(false)->index();
            $table->text('content')->nullable(true)->index();

            $table->timestamps();

            $table->foreign('source_id')->references('id')->on('sources')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        DB::statement('ALTER TABLE news ADD FULLTEXT fulltext_news_title(title)');
        DB::statement('ALTER TABLE news ADD FULLTEXT fulltext_news_description(description)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
