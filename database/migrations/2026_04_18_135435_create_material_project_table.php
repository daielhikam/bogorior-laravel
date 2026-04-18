<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('material_project')) {
            Schema::create('material_project', function (Blueprint $table) {
                $table->increments('id_material');
                $table->integer('id_project')->unsigned();
                $table->string('nama_material', 100);
                $table->enum('jenis_material', ['kabinet', 'countertop', 'hardware', 'finishing', 'aksesoris']);
                $table->text('spesifikasi')->nullable();
                $table->string('merk', 50)->nullable();
                $table->integer('jumlah')->default(1);
                $table->string('satuan', 20)->nullable();
                $table->timestamps();
                
                $table->index('id_project');
                $table->index('jenis_material');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('material_project');
    }
};