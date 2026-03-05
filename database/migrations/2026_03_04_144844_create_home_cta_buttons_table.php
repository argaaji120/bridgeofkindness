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
        Schema::create('home_cta_buttons', function (Blueprint $table) {
            $table->id();
            $table->string('title_prefix')->nullable();
            $table->string('title_highlight')->nullable();
            $table->string('title_suffix')->nullable();
            $table->string('image');
            $table->string('link')->nullable();
            $table->integer('sort')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_cta_buttons');
    }
};
