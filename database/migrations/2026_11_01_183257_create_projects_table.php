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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('portfolio', 10)->index();
            $table->string('title', 120);
            $table->text('description');
            $table->json('tech_stack');
            $table->string('project_url')->nullable();
            $table->string('repository_url')->nullable();
            $table->string('image_path')->nullable();
            $table->date('completed_at')->nullable();
            $table->unsignedSmallInteger('display_order')->default(0);
            $table->unique(['portfolio', 'title']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
