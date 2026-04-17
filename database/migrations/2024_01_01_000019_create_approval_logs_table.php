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
        if (!Schema::hasTable('approval_logs')) {
            Schema::create('approval_logs', function (Blueprint $table) {
                // Primary Key
                $table->increments('id_approval');
                
                // Admin being approved
                $table->integer('id_admin')->unsigned();
                
                // Action Details
                $table->enum('action', ['register', 'activate', 'deactivate', 'delete']);
                $table->enum('status_from', ['pending', 'active', 'inactive']);
                $table->enum('status_to', ['pending', 'active', 'inactive']);
                $table->text('reason')->nullable();
                
                // Who performed the action
                $table->integer('performed_by')->unsigned();
                
                // Timestamps
                $table->timestamps();
                
                // Indexes
                $table->index('id_admin');
                $table->index('performed_by');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('approval_logs')) {
            Schema::dropIfExists('approval_logs');
        }
    }
};