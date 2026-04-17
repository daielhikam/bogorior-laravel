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
        if (!Schema::hasTable('testimoni')) {
            Schema::create('testimoni', function (Blueprint $table) {
                // Primary Key
                $table->increments('id_testimoni');
                
                // Foreign Key
                $table->integer('id_project')->unsigned()->nullable();
                
                // Client Info
                $table->string('nama_client', 100);
                $table->string('foto_client', 255)->nullable();
                $table->string('jenis_project', 50)->nullable();
                $table->string('lokasi', 100)->nullable();
                
                // Testimonial Content
                $table->integer('rating');
                $table->text('testimoni');
                
                // Video Support
                $table->string('url_video', 500)->nullable();
                $table->enum('video_platform', ['youtube', 'vimeo', 'tiktok', 'instagram', 'facebook', 'local'])->nullable();
                $table->string('video_id', 200)->nullable();
                $table->string('video_thumbnail', 255)->nullable();
                
                // Status
                $table->enum('status_testimoni', ['pending', 'approved', 'featured', 'arsip'])->default('pending');
                $table->enum('tipe_testimoni', ['teks', 'video'])->default('teks');
                $table->tinyInteger('featured')->default(0);
                
                // Date
                $table->date('tanggal_testimoni')->nullable();
                
                // Timestamps
                $table->timestamps();
                
                // Indexes
                $table->index('id_project');
                $table->index('status_testimoni');
                $table->index('featured');
                $table->index('rating');
                $table->index('tipe_testimoni');
                $table->index('video_platform');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('testimoni')) {
            Schema::dropIfExists('testimoni');
        }
    }
};