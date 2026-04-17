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
        if (!Schema::hasTable('admin_sessions')) {
            Schema::create('admin_sessions', function (Blueprint $table) {
                // Primary Key
                $table->increments('id_session');
                
                // Foreign Key
                $table->integer('admin_id')->unsigned();
                
                // Session Data
                $table->string('token', 128)->unique();
                $table->datetime('expires_at');
                $table->datetime('last_activity');
                
                // Metadata
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                
                // Timestamps
                $table->timestamps();
                
                // Indexes
                $table->index('admin_id');
                $table->index('token');
                $table->index('expires_at');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('admin_sessions')) {
            Schema::dropIfExists('admin_sessions');
        }
    }
};