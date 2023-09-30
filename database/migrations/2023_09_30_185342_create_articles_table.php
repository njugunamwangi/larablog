<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title', 2048);
            $table->string('slug', 2048);
            $table->longText('body');
            $table->string('status');
            $table->datetime('published_at')->nullable();
            $table->datetime('scheduled_for')->nullable();
            $table->foreignId( 'author_id')->references('id')->on('users');
            $table->foreignId( 'editor_id')->references('id')->on('users');
            $table->string('meta_title', 255)->nullable();
            $table->string('meta_description', 255)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
