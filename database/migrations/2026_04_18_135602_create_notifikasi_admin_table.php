<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('notifikasi_admin')) {
            Schema::create('notifikasi_admin', function (Blueprint $table) {
                $table->increments('id_notifikasi');
                $table->integer('id_admin')->unsigned()->nullable();
                $table->enum('tipe_notifikasi', ['info', 'warning', 'success', 'danger'])->default('info');
                $table->string('judul', 200);
                $table->text('pesan');
                $table->string('link', 255)->nullable();
                $table->tinyInteger('dibaca')->default(0);
                $table->datetime('dibaca_pada')->nullable();
                $table->timestamps();
                
                $table->index('id_admin');
                $table->index('dibaca');
                $table->index('tipe_notifikasi');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('notifikasi_admin');
    }
};