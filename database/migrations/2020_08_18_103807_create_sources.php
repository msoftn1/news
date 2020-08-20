<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSources extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sources', function (Blueprint $table) {
            $table->id();
            $table->string('identifier')->nullable(false)->unique();
            $table->string('name')->nullable(false);
            $table->text('description')->nullable(true);
            $table->string('url')->nullable(true);
            $table->string('category')->nullable(false)->index();
            $table->string('language')->nullable(false)->index();
            $table->string('country')->nullable(false)->index();

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
        Schema::dropIfExists('sources');
    }
}
