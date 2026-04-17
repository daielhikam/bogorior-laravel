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
        if (!Schema::hasTable('artikel')) {
            Schema::create('artikel', function (Blueprint $table) {
                // Primary Key
                $table->increments('id_artikel');
                
                // Article Identity
                $table->string('judul_artikel', 200);
                $table->string('slug', 255)->unique();
                $table->longText('konten');
                $table->text('excerpt')->nullable();
                
                // Media
                $table->string('gambar_utama', 255)->nullable();
                
                // Categorization
                $table->enum('kategori', ['tips_panduan', 'desain_inspirasi', 'perawatan_maintenance', 'material_finishing', 'tren_terbaru', 'case_study']);
                $table->text('tags')->nullable();
                
                // Author & Status
                $table->string('penulis', 100)->default('Admin Bogorior');
                $table->enum('status_artikel', ['draft', 'publish', 'featured', 'arsip'])->default('draft');
                $table->tinyInteger('featured')->default(0);
                $table->date('tanggal_publish')->nullable();
                
                // Statistics
                $table->integer('views')->default(0);
                
                // SEO
                $table->string('meta_title', 200)->nullable();
                $table->string('meta_description', 300)->nullable();
                
                // Timestamps
                $table->timestamps();
                
                // Indexes
                $table->index('kategori');
                $table->index('status_artikel');
                $table->index('featured');
                $table->index('tanggal_publish');
                $table->index('views');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('artikel')) {
            Schema::dropIfExists('artikel');
        }
    }
};