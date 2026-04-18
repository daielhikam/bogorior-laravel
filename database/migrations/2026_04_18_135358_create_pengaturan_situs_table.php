<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('pengaturan_situs')) {
            Schema::create('pengaturan_situs', function (Blueprint $table) {
                $table->increments('id_pengaturan');
                $table->string('kategori', 50);
                $table->string('kunci', 50)->unique();
                $table->text('nilai')->nullable();
                $table->enum('tipe', ['text', 'textarea', 'number', 'email', 'tel', 'url', 'boolean', 'json', 'select'])->default('text');
                $table->string('label', 100)->nullable();
                $table->string('placeholder', 100)->nullable();
                $table->text('opsi')->nullable();
                $table->integer('urutan')->default(0);
                $table->timestamps();
                
                $table->index('kategori');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaturan_situs');
    }
};