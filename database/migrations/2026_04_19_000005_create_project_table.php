<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('project')) {
            Schema::create('project', function (Blueprint $table) {
                $table->id('id_project');  // ← ini penting: nama kolom primary key adalah id_project
                $table->foreignId('id_pelanggan')->constrained('pelanggan', 'id_pelanggan')->onDelete('cascade');
                $table->foreignId('id_konsultasi')->nullable()->constrained('konsultasi', 'id_konsultasi')->onDelete('set null');
                $table->string('kode_project', 20)->unique();
                $table->string('nama_project', 100);
                $table->enum('jenis_project', ['custom', 'premium', 'renovasi', 'interior', 'konsultasi_desain']);
                $table->enum('kategori_desain', ['minimalist', 'modern', 'classic', 'luxury', 'contemporary', 'industrial']);
                $table->decimal('luas_area', 8, 2);
                $table->string('lokasi_project', 100);
                $table->text('alamat_lengkap')->nullable();
                $table->decimal('budget_project', 15, 2);
                $table->decimal('biaya_actual', 15, 2)->nullable();
                $table->string('durasi_pengerjaan', 50)->nullable();
                $table->text('deskripsi_project')->nullable();
                $table->text('testimoni_client')->nullable();
                $table->integer('rating_project')->nullable();
                $table->enum('status_project', ['desain', 'approval_desain', 'produksi', 'pemasangan', 'finishing', 'selesai', 'garansi'])->default('desain');
                $table->date('tanggal_mulai')->nullable();
                $table->date('tanggal_selesai')->nullable();
                $table->date('tanggal_garansi')->nullable();
                $table->timestamps();
                
                $table->index('status_project');
                $table->index('created_at');
                $table->index('kode_project');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('project');
    }
};