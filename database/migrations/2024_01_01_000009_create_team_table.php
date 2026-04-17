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
        if (!Schema::hasTable('team')) {
            Schema::create('team', function (Blueprint $table) {
                // Primary Key
                $table->increments('id_team');
                
                // Member Identity
                $table->string('nama_lengkap', 100);
                $table->string('posisi', 100);
                $table->string('foto', 255)->nullable();
                
                // Professional Info
                $table->text('bio')->nullable();
                $table->string('pengalaman', 100)->nullable();
                $table->text('keahlian')->nullable();
                
                // Contact
                $table->string('email', 100)->nullable();
                $table->string('no_whatsapp', 20)->nullable();
                
                // Display Settings
                $table->integer('urutan')->default(0);
                $table->tinyInteger('aktif')->default(1);
                
                // Timestamps
                $table->timestamps();
                
                // Indexes
                $table->index('aktif');
                $table->index('urutan');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('team')) {
            Schema::dropIfExists('team');
        }
    }
};