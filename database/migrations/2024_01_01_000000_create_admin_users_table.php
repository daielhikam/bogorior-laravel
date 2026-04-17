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
        // Cek apakah tabel sudah ada, jika sudah maka skip
        if (!Schema::hasTable('admin_users')) {
            Schema::create('admin_users', function (Blueprint $table) {
                // Primary Key
                $table->increments('id_admin');
                
                // Authentication Fields
                $table->string('username', 50)->unique();
                $table->string('password', 255);
                $table->string('nama_lengkap', 100);
                $table->string('email', 100)->unique();
                
                // Role & Status
                $table->enum('role', ['super_admin', 'admin', 'desainer', 'marketing', 'cs'])->default('admin');
                $table->tinyInteger('aktif')->default(1);
                $table->enum('approval_status', ['pending', 'approved', 'rejected'])->default('pending');
                
                // Profile Fields
                $table->string('foto_profil', 255)->nullable();
                $table->string('whatsapp', 20)->nullable();
                $table->text('alamat')->nullable();
                $table->text('bio')->nullable();
                
                // Registration & Approval
                $table->string('registration_key', 100)->unique()->nullable();
                $table->integer('registered_by')->nullable();
                $table->datetime('registered_at')->nullable();
                $table->integer('approved_by')->nullable();
                $table->datetime('approved_at')->nullable();
                $table->text('rejection_reason')->nullable();
                
                // Reset Password
                $table->string('reset_token', 100)->unique()->nullable();
                $table->datetime('reset_token_expires')->nullable();
                
                // Login Tracking
                $table->datetime('last_login')->nullable();
                $table->string('last_ip', 45)->nullable();
                
                // Timestamps
                $table->timestamps();
                
                // Indexes
                $table->index('role');
                $table->index('aktif');
                $table->index('approval_status');
                $table->index('registered_by');
                $table->index('approved_by');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hanya hapus jika tabel ada (untuk rollback)
        if (Schema::hasTable('admin_users')) {
            Schema::dropIfExists('admin_users');
        }
    }
};