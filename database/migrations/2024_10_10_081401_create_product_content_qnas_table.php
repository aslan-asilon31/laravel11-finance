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
    Schema::create('product_content_qnas', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->uuid('product_content_id');
      $table->foreign('product_content_id')->references('id')->on('product_contents')->onDelete('cascade')->onUpdate('cascade');
      $table->string('question', 255);
      $table->string('answer', 255);
      $table->string('created_by', 255)->nullable()->index();
      $table->string('updated_by', 255)->nullable()->index();
      $table->timestamps();
      $table->tinyInteger('ordinal')->unsigned()->default(0);
      $table->boolean('is_activated')->default(true);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('product_content_qnas');
  }
};
