<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('pesan_kontak')) {
            Schema::create('pesan_kontak', function (Blueprint $table) {
                $table->id('id_pesan');
                $table->string('nama_pengirim', 100);
                $table->string('email_pengirim', 100);
                $table->string('no_whatsapp', 20)->nullable();
                $table->string('subjek', 200);
                $table->text('pesan');
                $table->enum('status_pesan', ['baru', 'dibaca', 'dibalas', 'selesai'])->default('baru');
                $table->datetime('dibaca_pada')->nullable();
                $table->datetime('dibalas_pada')->nullable();
                $table->timestamps();
                
                $table->index('status_pesan');
                $table->index('created_at');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('pesan_kontak');
    }
};