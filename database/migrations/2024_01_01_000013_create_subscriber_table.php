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
        if (!Schema::hasTable('subscriber')) {
            Schema::create('subscriber', function (Blueprint $table) {
                // Primary Key
                $table->increments('id_subscriber');
                
                // Subscriber Info
                $table->string('email', 100)->unique();
                $table->string('nama', 100)->nullable();
                
                // Status
                $table->enum('status', ['aktif', 'unsubscribe', 'bounced'])->default('aktif');
                
                // Tracking
                $table->datetime('tanggal_subscribe')->nullable();
                $table->datetime('terakhir_kirim')->nullable();
                $table->string('token_unsubscribe', 100)->unique()->nullable();
                
                // Timestamps
                $table->timestamps();
                
                // Indexes
                $table->index('status');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('subscriber')) {
            Schema::dropIfExists('subscriber');
        }
    }
};