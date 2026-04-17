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
        // Cek apakah foreign key sudah ada sebelum menambahkan
        
        // Foreign Key untuk konsultasi ke pelanggan
        if (Schema::hasTable('konsultasi') && Schema::hasTable('pelanggan')) {
            $foreignKeys = $this->getForeignKeys('konsultasi');
            if (!in_array('konsultasi_id_pelanggan_foreign', $foreignKeys)) {
                Schema::table('konsultasi', function (Blueprint $table) {
                    $table->foreign('id_pelanggan', 'konsultasi_id_pelanggan_foreign')
                        ->references('id_pelanggan')
                        ->on('pelanggan')
                        ->onDelete('set null');
                });
            }
        }

        // Foreign Key untuk project ke pelanggan
        if (Schema::hasTable('project') && Schema::hasTable('pelanggan')) {
            $foreignKeysProject = $this->getForeignKeys('project');
            if (!in_array('project_id_pelanggan_foreign', $foreignKeysProject)) {
                Schema::table('project', function (Blueprint $table) {
                    $table->foreign('id_pelanggan', 'project_id_pelanggan_foreign')
                        ->references('id_pelanggan')
                        ->on('pelanggan')
                        ->onDelete('cascade');
                });
            }
        }

        // Foreign Key untuk project ke konsultasi
        if (Schema::hasTable('project') && Schema::hasTable('konsultasi')) {
            $foreignKeysProject = $this->getForeignKeys('project');
            if (!in_array('project_id_konsultasi_foreign', $foreignKeysProject)) {
                Schema::table('project', function (Blueprint $table) {
                    $table->foreign('id_konsultasi', 'project_id_konsultasi_foreign')
                        ->references('id_konsultasi')
                        ->on('konsultasi')
                        ->onDelete('set null');
                });
            }
        }

        // Foreign Key untuk gallery_project ke project
        if (Schema::hasTable('gallery_project') && Schema::hasTable('project')) {
            $foreignKeysGallery = $this->getForeignKeys('gallery_project');
            if (!in_array('gallery_project_id_project_foreign', $foreignKeysGallery)) {
                Schema::table('gallery_project', function (Blueprint $table) {
                    $table->foreign('id_project', 'gallery_project_id_project_foreign')
                        ->references('id_project')
                        ->on('project')
                        ->onDelete('cascade');
                });
            }
        }

        // Foreign Key untuk material_project ke project
        if (Schema::hasTable('material_project') && Schema::hasTable('project')) {
            $foreignKeysMaterial = $this->getForeignKeys('material_project');
            if (!in_array('material_project_id_project_foreign', $foreignKeysMaterial)) {
                Schema::table('material_project', function (Blueprint $table) {
                    $table->foreign('id_project', 'material_project_id_project_foreign')
                        ->references('id_project')
                        ->on('project')
                        ->onDelete('cascade');
                });
            }
        }

        // Foreign Key untuk testimoni ke project
        if (Schema::hasTable('testimoni') && Schema::hasTable('project')) {
            $foreignKeysTestimoni = $this->getForeignKeys('testimoni');
            if (!in_array('testimoni_id_project_foreign', $foreignKeysTestimoni)) {
                Schema::table('testimoni', function (Blueprint $table) {
                    $table->foreign('id_project', 'testimoni_id_project_foreign')
                        ->references('id_project')
                        ->on('project')
                        ->onDelete('cascade');
                });
            }
        }

        // Foreign Key untuk notifikasi_admin ke admin_users
        if (Schema::hasTable('notifikasi_admin') && Schema::hasTable('admin_users')) {
            $foreignKeysNotif = $this->getForeignKeys('notifikasi_admin');
            if (!in_array('notifikasi_admin_id_admin_foreign', $foreignKeysNotif)) {
                Schema::table('notifikasi_admin', function (Blueprint $table) {
                    $table->foreign('id_admin', 'notifikasi_admin_id_admin_foreign')
                        ->references('id_admin')
                        ->on('admin_users')
                        ->onDelete('cascade');
                });
            }
        }

        // Foreign Key untuk admin_sessions ke admin_users
        if (Schema::hasTable('admin_sessions') && Schema::hasTable('admin_users')) {
            $foreignKeysSessions = $this->getForeignKeys('admin_sessions');
            if (!in_array('admin_sessions_admin_id_foreign', $foreignKeysSessions)) {
                Schema::table('admin_sessions', function (Blueprint $table) {
                    $table->foreign('admin_id', 'admin_sessions_admin_id_foreign')
                        ->references('id_admin')
                        ->on('admin_users')
                        ->onDelete('cascade');
                });
            }
        }

        // Foreign Key untuk approval_logs
        if (Schema::hasTable('approval_logs') && Schema::hasTable('admin_users')) {
            $foreignKeysApproval = $this->getForeignKeys('approval_logs');
            if (!in_array('approval_logs_id_admin_foreign', $foreignKeysApproval)) {
                Schema::table('approval_logs', function (Blueprint $table) {
                    $table->foreign('id_admin', 'approval_logs_id_admin_foreign')
                        ->references('id_admin')
                        ->on('admin_users')
                        ->onDelete('cascade');
                    
                    $table->foreign('performed_by', 'approval_logs_performed_by_foreign')
                        ->references('id_admin')
                        ->on('admin_users')
                        ->onDelete('cascade');
                });
            }
        }
    }

    /**
     * Get existing foreign keys for a table.
     */
    private function getForeignKeys(string $tableName): array
    {
        try {
            $connection = Schema::getConnection();
            $databaseName = $connection->getDatabaseName();
            
            $results = $connection->select("
                SELECT CONSTRAINT_NAME 
                FROM information_schema.KEY_COLUMN_USAGE 
                WHERE TABLE_SCHEMA = ? 
                AND TABLE_NAME = ? 
                AND REFERENCED_TABLE_NAME IS NOT NULL
            ", [$databaseName, $tableName]);
            
            return array_column($results, 'CONSTRAINT_NAME');
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus foreign keys jika ada
        $tables = ['konsultasi', 'project', 'gallery_project', 'material_project', 'testimoni', 'notifikasi_admin', 'admin_sessions', 'approval_logs'];
        
        foreach ($tables as $tableName) {
            if (Schema::hasTable($tableName)) {
                // Drop foreign keys based on table name
                $foreignKeysToDrop = [];
                
                switch ($tableName) {
                    case 'konsultasi':
                        $foreignKeysToDrop = ['konsultasi_id_pelanggan_foreign'];
                        break;
                    case 'project':
                        $foreignKeysToDrop = ['project_id_pelanggan_foreign', 'project_id_konsultasi_foreign'];
                        break;
                    case 'gallery_project':
                        $foreignKeysToDrop = ['gallery_project_id_project_foreign'];
                        break;
                    case 'material_project':
                        $foreignKeysToDrop = ['material_project_id_project_foreign'];
                        break;
                    case 'testimoni':
                        $foreignKeysToDrop = ['testimoni_id_project_foreign'];
                        break;
                    case 'notifikasi_admin':
                        $foreignKeysToDrop = ['notifikasi_admin_id_admin_foreign'];
                        break;
                    case 'admin_sessions':
                        $foreignKeysToDrop = ['admin_sessions_admin_id_foreign'];
                        break;
                    case 'approval_logs':
                        $foreignKeysToDrop = ['approval_logs_id_admin_foreign', 'approval_logs_performed_by_foreign'];
                        break;
                }
                
                foreach ($foreignKeysToDrop as $fk) {
                    try {
                        Schema::table($tableName, function (Blueprint $table) use ($fk) {
                            $table->dropForeign($fk);
                        });
                    } catch (\Exception $e) {
                        // Foreign key might not exist, continue
                    }
                }
            }
        }
    }
};