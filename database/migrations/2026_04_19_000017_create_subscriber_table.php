<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('subscriber')) {
            Schema::create('subscriber', function (Blueprint $table) {
                $table->id('id_subscriber');
                $table->string('email', 100)->unique();
                $table->string('nama', 100)->nullable();
                $table->enum('status', ['aktif', 'unsubscribe', 'bounced'])->default('aktif');
                $table->datetime('tanggal_subscribe')->nullable();
                $table->datetime('terakhir_kirim')->nullable();
                $table->string('token_unsubscribe', 100)->unique()->nullable();
                $table->timestamps();
                
                $table->index('status');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('subscriber');
    }
};