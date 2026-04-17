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
        if (!Schema::hasTable('halaman')) {
            Schema::create('halaman', function (Blueprint $table) {
                // Primary Key
                $table->increments('id_halaman');
                
                // Page Identity
                $table->string('judul_halaman', 200);
                $table->string('slug_halaman', 100)->unique();
                $table->longText('konten')->nullable();
                $table->enum('jenis_halaman', ['tentang', 'kontak', 'syarat_ketentuan', 'kebijakan_privasi', 'faq', 'lainnya'])->default('lainnya');
                
                // SEO
                $table->string('meta_title', 200)->nullable();
                $table->text('meta_description')->nullable();
                
                // Status
                $table->enum('status_halaman', ['draft', 'publish'])->default('publish');
                $table->integer('urutan')->default(0);
                
                // Timestamps
                $table->timestamps();
                
                // Indexes
                $table->index('jenis_halaman');
                $table->index('status_halaman');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('halaman')) {
            Schema::dropIfExists('halaman');
        }
    }
};