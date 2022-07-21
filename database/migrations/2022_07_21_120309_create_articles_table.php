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
            $table->string('imageUrl');
            $table->string('newsSite')->nullable();
            $table->text('summary')->nullable();
            $table->dateTime('publishedAt');
            $table->dateTime('updatedAt');
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
