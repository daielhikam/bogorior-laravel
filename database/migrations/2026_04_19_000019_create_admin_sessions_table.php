<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('admin_sessions')) {
            Schema::create('admin_sessions', function (Blueprint $table) {
                $table->id('id_session');
                // Perbaikan: tentukan kolom referensi yang benar (id_admin)
                $table->foreignId('admin_id')->constrained('admin_users', 'id_admin')->onDelete('cascade');
                $table->string('token', 128)->unique();
                $table->datetime('expires_at');
                $table->datetime('last_activity');
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->timestamps();
                
                $table->index('token');
                $table->index('expires_at');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_sessions');
    }
};