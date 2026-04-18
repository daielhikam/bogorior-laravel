<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('admin_users')) {
            Schema::create('admin_users', function (Blueprint $table) {
                $table->increments('id_admin');
                $table->string('username', 50)->unique();
                $table->string('password', 255);
                $table->string('nama_lengkap', 100);
                $table->string('email', 100)->unique();
                $table->enum('role', ['super_admin', 'admin', 'desainer', 'marketing', 'cs'])->default('admin');
                $table->tinyInteger('aktif')->default(1);
                $table->enum('approval_status', ['pending', 'approved', 'rejected'])->default('pending');
                $table->string('foto_profil', 255)->nullable();
                $table->string('whatsapp', 20)->nullable();
                $table->text('alamat')->nullable();
                $table->text('bio')->nullable();
                $table->string('registration_key', 100)->unique()->nullable();
                $table->integer('registered_by')->nullable();
                $table->datetime('registered_at')->nullable();
                $table->integer('approved_by')->nullable();
                $table->datetime('approved_at')->nullable();
                $table->text('rejection_reason')->nullable();
                $table->string('reset_token', 100)->unique()->nullable();
                $table->datetime('reset_token_expires')->nullable();
                $table->datetime('last_login')->nullable();
                $table->string('last_ip', 45)->nullable();
                $table->timestamps();
                
                $table->index('role');
                $table->index('aktif');
                $table->index('approval_status');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_users');
    }
};