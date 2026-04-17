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
        if (!Schema::hasTable('project')) {
            Schema::create('project', function (Blueprint $table) {
                // Primary Key
                $table->increments('id_project');
                
                // Foreign Keys
                $table->integer('id_pelanggan')->unsigned();
                $table->integer('id_konsultasi')->unsigned()->nullable();
                
                // Project Identity
                $table->string('kode_project', 20)->unique();
                $table->string('nama_project', 100);
                
                // Project Type & Design
                $table->enum('jenis_project', ['custom', 'premium', 'renovasi', 'interior', 'konsultasi_desain']);
                $table->enum('kategori_desain', ['minimalist', 'modern', 'classic', 'luxury', 'contemporary', 'industrial']);
                
                // Project Details
                $table->decimal('luas_area', 8, 2);
                $table->string('lokasi_project', 100);
                $table->text('alamat_lengkap')->nullable();
                
                // Budget & Cost
                $table->decimal('budget_project', 15, 2);
                $table->decimal('biaya_actual', 15, 2)->nullable();
                
                // Timeline
                $table->string('durasi_pengerjaan', 50)->nullable();
                $table->date('tanggal_mulai')->nullable();
                $table->date('tanggal_selesai')->nullable();
                $table->date('tanggal_garansi')->nullable();
                
                // Description & Testimonial
                $table->text('deskripsi_project')->nullable();
                $table->text('testimoni_client')->nullable();
                $table->integer('rating_project')->nullable();
                
                // Status
                $table->enum('status_project', ['desain', 'approval_desain', 'produksi', 'pemasangan', 'finishing', 'selesai', 'garansi'])->default('desain');
                
                // Timestamps
                $table->timestamps();
                
                // Indexes
                $table->index('id_pelanggan');
                $table->index('id_konsultasi');
                $table->index('status_project');
                $table->index('created_at');
                $table->index(['id_pelanggan', 'status_project']);
                $table->index('budget_project');
                $table->index('kode_project');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('project')) {
            Schema::dropIfExists('project');
        }
    }
};