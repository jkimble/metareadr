<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new   class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('name');
            $table->text('bio')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('death_date')->nullable();
            $table->string('top_work')->nullable();
            $table->float('ratings_average')->nullable();
            $table->integer('work_count')->nullable();
            $table->json('works')->nullable();
            $table->timestamps();
        });

        Schema::create('author_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('author_user');
        Schema::dropIfExists('authors');
    }
};
