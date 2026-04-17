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
        if (!Schema::hasTable('notifikasi_admin')) {
            Schema::create('notifikasi_admin', function (Blueprint $table) {
                // Primary Key
                $table->increments('id_notifikasi');
                
                // Foreign Key
                $table->integer('id_admin')->unsigned()->nullable();
                
                // Notification Details
                $table->enum('tipe_notifikasi', ['info', 'warning', 'success', 'danger'])->default('info');
                $table->string('judul', 200);
                $table->text('pesan');
                $table->string('link', 255)->nullable();
                
                // Read Status
                $table->tinyInteger('dibaca')->default(0);
                $table->datetime('dibaca_pada')->nullable();
                
                // Timestamps
                $table->timestamps();
                
                // Indexes
                $table->index('id_admin');
                $table->index('dibaca');
                $table->index('tipe_notifikasi');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('notifikasi_admin')) {
            Schema::dropIfExists('notifikasi_admin');
        }
    }
};