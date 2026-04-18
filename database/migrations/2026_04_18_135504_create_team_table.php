<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('team')) {
            Schema::create('team', function (Blueprint $table) {
                $table->increments('id_team');
                $table->string('nama_lengkap', 100);
                $table->string('posisi', 100);
                $table->string('foto', 255)->nullable();
                $table->text('bio')->nullable();
                $table->string('pengalaman', 100)->nullable();
                $table->text('keahlian')->nullable();
                $table->string('email', 100)->nullable();
                $table->string('no_whatsapp', 20)->nullable();
                $table->integer('urutan')->default(0);
                $table->tinyInteger('aktif')->default(1);
                $table->timestamps();
                
                $table->index('aktif');
                $table->index('urutan');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('team');
    }
};