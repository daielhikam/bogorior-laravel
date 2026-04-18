<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('approval_logs')) {
            Schema::create('approval_logs', function (Blueprint $table) {
                $table->increments('id_approval');
                $table->integer('id_admin')->unsigned();
                $table->enum('action', ['register', 'activate', 'deactivate', 'delete']);
                $table->enum('status_from', ['pending', 'active', 'inactive']);
                $table->enum('status_to', ['pending', 'active', 'inactive']);
                $table->text('reason')->nullable();
                $table->integer('performed_by')->unsigned();
                $table->timestamps();
                
                $table->index('id_admin');
                $table->index('performed_by');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('approval_logs');
    }
};