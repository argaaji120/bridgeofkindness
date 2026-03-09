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
        Schema::create('news_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('description')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->timestamps();
        });

        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content');
            $table->string('featured_image');
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->date('published_at');
            $table->timestamps();

            $table->foreign('author_id')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });

        Schema::create('news_has_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('news_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->foreign('news_id')
                ->references('id')
                ->on('news')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('category_id')
                ->references('id')
                ->on('news_categories')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->unique(['news_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // ensures smooth rollbacks across different database systems
        Schema::table('news_has_categories', function (Blueprint $table) {
            $table->dropForeign(['news_id']);
            $table->dropForeign(['category_id']);
        });

        Schema::table('news', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
        });

        Schema::dropIfExists('news_categories');
        Schema::dropIfExists('news');
        Schema::dropIfExists('news_has_categories');
    }
};
