<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MigrateDataFromOldDatabaseSeeder extends Seeder
{
    /**
     * Run the seeder.
     * 
     * CATATAN: Seeder ini hanya digunakan jika Anda memiliki database lama
     * dan ingin memigrasikan datanya. Pastikan konfigurasi database 'mysql_old'
     * sudah ditambahkan di config/database.php sebelum menjalankan seeder ini.
     * 
     * Untuk mengaktifkan, uncomment kode di bawah ini dan sesuaikan.
     */
    public function run(): void
    {
        $this->command->info('==========================================');
        $this->command->info('📦 Migrating data from old database...');
        $this->command->info('==========================================');
        
        // Cek apakah koneksi database lama tersedia
        try {
            $oldDB = DB::connection('mysql_old');
            $oldDB->getPdo();
            $this->command->info('✅ Connected to old database');
        } catch (\Exception $e) {
            $this->command->error('❌ Cannot connect to old database. Skipping migration.');
            $this->command->error('   Please configure mysql_old connection in config/database.php');
            return;
        }
        
        // ============================================================
        // MIGRATE ARTICLES
        // ============================================================
        $this->command->info('');
        $this->command->info('📝 Migrating articles...');
        
        try {
            $articles = $oldDB->table('artikel')->get();
            $articleCount = 0;
            
            foreach ($articles as $article) {
                // Cek apakah artikel sudah ada
                $exists = DB::table('artikel')->where('slug', $article->slug)->exists();
                
                if (!$exists) {
                    DB::table('artikel')->insert([
                        'id_artikel' => $article->id_artikel,
                        'judul_artikel' => $article->judul_artikel,
                        'slug' => $article->slug,
                        'konten' => $article->konten,
                        'excerpt' => $article->excerpt,
                        'gambar_utama' => $article->gambar_utama,
                        'kategori' => $article->kategori,
                        'tags' => $article->tags,
                        'penulis' => $article->penulis,
                        'status_artikel' => $article->status_artikel,
                        'featured' => $article->featured,
                        'tanggal_publish' => $article->tanggal_publish,
                        'views' => $article->views,
                        'meta_title' => $article->meta_title,
                        'meta_description' => $article->meta_description,
                        'created_at' => $article->created_at,
                        'updated_at' => $article->updated_at,
                    ]);
                    $articleCount++;
                }
            }
            
            $this->command->info("✅ Migrated {$articleCount} articles");
        } catch (\Exception $e) {
            $this->command->error('❌ Failed to migrate articles: ' . $e->getMessage());
        }
        
        // ============================================================
        // MIGRATE PROJECTS
        // ============================================================
        $this->command->info('');
        $this->command->info('🏗️ Migrating projects...');
        
        try {
            $projects = $oldDB->table('project')->get();
            $projectCount = 0;
            
            foreach ($projects as $project) {
                // Cek apakah project sudah ada
                $exists = DB::table('project')->where('kode_project', $project->kode_project)->exists();
                
                if (!$exists) {
                    DB::table('project')->insert([
                        'id_project' => $project->id_project,
                        'id_pelanggan' => $project->id_pelanggan,
                        'id_konsultasi' => $project->id_konsultasi,
                        'kode_project' => $project->kode_project,
                        'nama_project' => $project->nama_project,
                        'jenis_project' => $project->jenis_project,
                        'kategori_desain' => $project->kategori_desain,
                        'luas_area' => $project->luas_area,
                        'lokasi_project' => $project->lokasi_project,
                        'alamat_lengkap' => $project->alamat_lengkap,
                        'budget_project' => $project->budget_project,
                        'biaya_actual' => $project->biaya_actual,
                        'durasi_pengerjaan' => $project->durasi_pengerjaan,
                        'deskripsi_project' => $project->deskripsi_project,
                        'testimoni_client' => $project->testimoni_client,
                        'rating_project' => $project->rating_project,
                        'status_project' => $project->status_project,
                        'tanggal_mulai' => $project->tanggal_mulai,
                        'tanggal_selesai' => $project->tanggal_selesai,
                        'tanggal_garansi' => $project->tanggal_garansi,
                        'created_at' => $project->created_at,
                        'updated_at' => $project->updated_at,
                    ]);
                    $projectCount++;
                }
            }
            
            $this->command->info("✅ Migrated {$projectCount} projects");
        } catch (\Exception $e) {
            $this->command->error('❌ Failed to migrate projects: ' . $e->getMessage());
        }
        
        // ============================================================
        // MIGRATE TESTIMONIALS
        // ============================================================
        $this->command->info('');
        $this->command->info('⭐ Migrating testimonials...');
        
        try {
            $testimonials = $oldDB->table('testimoni')->get();
            $testimonialCount = 0;
            
            foreach ($testimonials as $testimonial) {
                // Cek apakah testimonial sudah ada
                $exists = DB::table('testimoni')->where('id_testimoni', $testimonial->id_testimoni)->exists();
                
                if (!$exists) {
                    DB::table('testimoni')->insert([
                        'id_testimoni' => $testimonial->id_testimoni,
                        'id_project' => $testimonial->id_project,
                        'nama_client' => $testimonial->nama_client,
                        'foto_client' => $testimonial->foto_client,
                        'url_video' => $testimonial->url_video,
                        'video_platform' => $testimonial->video_platform,
                        'video_id' => $testimonial->video_id,
                        'video_thumbnail' => $testimonial->video_thumbnail,
                        'rating' => $testimonial->rating,
                        'testimoni' => $testimonial->testimoni,
                        'jenis_project' => $testimonial->jenis_project,
                        'lokasi' => $testimonial->lokasi,
                        'status_testimoni' => $testimonial->status_testimoni,
                        'tipe_testimoni' => $testimonial->tipe_testimoni,
                        'featured' => $testimonial->featured,
                        'tanggal_testimoni' => $testimonial->tanggal_testimoni,
                        'created_at' => $testimonial->created_at,
                        'updated_at' => $testimonial->updated_at,
                    ]);
                    $testimonialCount++;
                }
            }
            
            $this->command->info("✅ Migrated {$testimonialCount} testimonials");
        } catch (\Exception $e) {
            $this->command->error('❌ Failed to migrate testimonials: ' . $e->getMessage());
        }
        
        // ============================================================
        // SELESAI
        // ============================================================
        $this->command->info('');
        $this->command->info('==========================================');
        $this->command->info('✅ Data migration completed successfully!');
        $this->command->info('==========================================');
    }
}