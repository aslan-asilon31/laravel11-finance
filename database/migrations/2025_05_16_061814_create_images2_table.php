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
        // Schema::create('images', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('url');
        //     $table->unsignedBigInteger('imageable_id');
        //     $table->string('imageable_type');
        //     $table->timestamps();
        // });

        // Schema::create('videos', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('title');
        //     $table->string('url');
        //     $table->timestamps();
        // });

        // Tabel comments (polymorphic)
        // Schema::create('comments', function (Blueprint $table) {
        //     $table->id();
        //     $table->text('body');

        //     // Kolom untuk relasi polymorphic
        //     $table->unsignedBigInteger('commentable_id');
        //     $table->string('commentable_type');

        //     $table->timestamps();

        //     // Index untuk optimasi query polymorphic
        //     $table->index(['commentable_id', 'commentable_type']);
        // });

        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Tabel taggables (pivot polymorphic)
        Schema::create('taggables', function (Blueprint $table) {
            $table->unsignedBigInteger('tag_id');
            $table->unsignedBigInteger('taggable_id');
            $table->string('taggable_type');

            // Index untuk performa query
            $table->index(['tag_id']);
            $table->index(['taggable_id', 'taggable_type']);

            // Optional: foreign key constraint
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
        Schema::dropIfExists('taggables');
        // Schema::dropIfExists('videos');
    }
};
