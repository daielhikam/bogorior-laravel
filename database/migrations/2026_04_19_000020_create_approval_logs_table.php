<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('approval_logs')) {
            Schema::create('approval_logs', function (Blueprint $table) {
                $table->id('id_approval');
                // Perbaikan: tentukan kolom referensi yang benar (id_admin)
                $table->foreignId('id_admin')->constrained('admin_users', 'id_admin')->onDelete('cascade');
                $table->enum('action', ['register', 'activate', 'deactivate', 'delete']);
                $table->enum('status_from', ['pending', 'active', 'inactive']);
                $table->enum('status_to', ['pending', 'active', 'inactive']);
                $table->text('reason')->nullable();
                $table->foreignId('performed_by')->constrained('admin_users', 'id_admin')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('approval_logs');
    }
};