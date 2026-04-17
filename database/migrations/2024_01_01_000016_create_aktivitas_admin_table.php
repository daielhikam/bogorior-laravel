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
        if (!Schema::hasTable('aktivitas_admin')) {
            Schema::create('aktivitas_admin', function (Blueprint $table) {
                // Primary Key
                $table->increments('id_aktivitas');
                
                // Admin Info (denormalized for history)
                $table->integer('id_admin')->unsigned()->nullable();
                $table->string('nama_admin', 100)->nullable();
                $table->string('role_admin', 50)->nullable();
                
                // Activity Details
                $table->enum('tipe_aktivitas', ['login', 'logout', 'create', 'update', 'delete', 'export', 'import', 'backup']);
                $table->string('modul', 50);
                $table->text('deskripsi')->nullable();
                
                // Data Changes (JSON)
                $table->json('data_sebelum')->nullable();
                $table->json('data_sesudah')->nullable();
                
                // Metadata
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                
                // Timestamps
                $table->timestamps();
                
                // Indexes
                $table->index('nama_admin');
                $table->index('role_admin');
                $table->index('tipe_aktivitas');
                $table->index('modul');
                $table->index('created_at');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('aktivitas_admin')) {
            Schema::dropIfExists('aktivitas_admin');
        }
    }
};