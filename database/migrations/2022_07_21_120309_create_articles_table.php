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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url')->unique();
            $table->string('imageUrl')->unique();
            $table->string('newsSite');
            $table->text('summary');
            $table->dateTimeTz('publishedAt');
            $table->dateTimeTz('updatedAt');
            $table->boolean('featured')->default(false);
            $table->longText('launches')->nullable();
            $table->longText('events')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
};
