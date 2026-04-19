<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('aktivitas_admin')) {
            Schema::create('aktivitas_admin', function (Blueprint $table) {
                $table->id('id_aktivitas');
                // Perbaikan: tentukan kolom referensi yang benar (id_admin)
                $table->foreignId('id_admin')->nullable()->constrained('admin_users', 'id_admin')->onDelete('set null');
                $table->string('nama_admin', 100)->nullable();
                $table->string('role_admin', 50)->nullable();
                $table->enum('tipe_aktivitas', ['login', 'logout', 'create', 'update', 'delete', 'export', 'import', 'backup']);
                $table->string('modul', 50);
                $table->text('deskripsi')->nullable();
                $table->json('data_sebelum')->nullable();
                $table->json('data_sesudah')->nullable();
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->timestamps();
                
                $table->index('tipe_aktivitas');
                $table->index('modul');
                $table->index('created_at');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('aktivitas_admin');
    }
};