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
        if (!Schema::hasTable('pengaturan_situs')) {
            Schema::create('pengaturan_situs', function (Blueprint $table) {
                // Primary Key
                $table->increments('id_pengaturan');
                
                // Setting Identity
                $table->string('kategori', 50);
                $table->string('kunci', 50)->unique();
                $table->text('nilai')->nullable();
                
                // Setting Metadata
                $table->enum('tipe', ['text', 'textarea', 'number', 'email', 'tel', 'url', 'boolean', 'json', 'select'])->default('text');
                $table->string('label', 100)->nullable();
                $table->string('placeholder', 100)->nullable();
                $table->text('opsi')->nullable();
                $table->integer('urutan')->default(0);
                
                // Timestamps
                $table->timestamps();
                
                // Indexes
                $table->index('kategori');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('pengaturan_situs')) {
            Schema::dropIfExists('pengaturan_situs');
        }
    }
};