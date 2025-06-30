<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('title');
            $table->json('author_names')->nullable();
            $table->string('author_key')->nullable();
            $table->integer('first_publish_year')->nullable();
            $table->json('subjects')->nullable();
            $table->json('isbn')->nullable();
            $table->integer('cover_i')->nullable();
            $table->string('cover_edition_key')->nullable();
            $table->integer('ratings_count')->nullable();
            $table->integer('number_of_pages_median')->nullable();
            $table->text('first_sentence')->nullable();
            $table->timestamps();
        });

        Schema::create('book_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
        Schema::dropIfExists('book_users');
    }
};
