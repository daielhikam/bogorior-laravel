<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('admin_sessions')) {
            Schema::create('admin_sessions', function (Blueprint $table) {
                $table->increments('id_session');
                $table->integer('admin_id')->unsigned();
                $table->string('token', 128)->unique();
                $table->datetime('expires_at');
                $table->datetime('last_activity');
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->timestamps();
                
                $table->index('admin_id');
                $table->index('token');
                $table->index('expires_at');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_sessions');
    }
};