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
        if (!Schema::hasTable('faq')) {
            Schema::create('faq', function (Blueprint $table) {
                // Primary Key
                $table->increments('id_faq');
                
                // Content
                $table->text('pertanyaan');
                $table->text('jawaban');
                
                // Categorization
                $table->enum('kategori', ['layanan', 'pembayaran', 'garansi', 'pemasangan', 'material', 'umum'])->default('umum');
                
                // Display Settings
                $table->integer('urutan')->default(0);
                $table->tinyInteger('aktif')->default(1);
                
                // Timestamps
                $table->timestamps();
                
                // Indexes
                $table->index('kategori');
                $table->index('aktif');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('faq')) {
            Schema::dropIfExists('faq');
        }
    }
};