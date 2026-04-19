<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('faq')) {
            Schema::create('faq', function (Blueprint $table) {
                $table->id('id_faq');
                $table->text('pertanyaan');
                $table->text('jawaban');
                $table->enum('kategori', ['layanan', 'pembayaran', 'garansi', 'pemasangan', 'material', 'umum'])->default('umum');
                $table->integer('urutan')->default(0);
                $table->boolean('aktif')->default(true);
                $table->timestamps();
                
                $table->index('kategori');
                $table->index('aktif');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('faq');
    }
};