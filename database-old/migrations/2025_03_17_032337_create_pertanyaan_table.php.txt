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
        Schema::create('pertanyaans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('asesmen_id');
            $table->foreign('asesmen_id')->references('id')->on('asesmens')->onDelete('cascade')->onUpdate('cascade');
            $table->string('pertanyaan')->nullable();
            $table->string('jenis')->nullable();
            $table->integer('durasi')->nullable();
            $table->integer('bobot')->nullable();
            $table->string('dibuat_oleh')->nullable();
            $table->string('diupdate_oleh')->nullable();
            $table->timestamp('tgl_dibuat')->nullable();
            $table->timestamp('tgl_diupdate')->nullable();
            $table->integer('no_urut')->nullable();
            $table->boolean('apa_aktif')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asesmen_users');
    }
};
