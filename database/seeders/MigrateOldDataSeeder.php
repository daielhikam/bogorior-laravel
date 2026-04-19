<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class MigrateOldDataSeeder extends Seeder
{
    /**
     * Run the seeder to migrate data from old database.
     */
    public function run(): void
    {
        $this->command->info('==========================================');
        $this->command->info('📦 Migrating Data from Old Database');
        $this->command->info('==========================================');
        
        // Cek koneksi database lama
        try {
            DB::connection('mysql_old')->getPdo();
            $this->command->info('✅ Connected to old database successfully');
        } catch (\Exception $e) {
            $this->command->error('❌ Cannot connect to old database: ' . $e->getMessage());
            $this->command->error('   Please check your .env configuration for DB_OLD_* variables');
            return;
        }
        
        // ============================================================
        // 1. MIGRASI ADMIN USERS
        // ============================================================
        $this->command->info('');
        $this->command->info('👤 Migrating admin_users...');
        $this->migrateAdminUsers();
        
        // ============================================================
        // 2. MIGRASI PENGATURAN SITUS
        // ============================================================
        $this->command->info('');
        $this->command->info('⚙️ Migrating settings...');
        $this->migrateSettings();
        
        // ============================================================
        // 3. MIGRASI AREA LAYANAN
        // ============================================================
        $this->command->info('');
        $this->command->info('🗺️ Migrating service areas...');
        $this->migrateAreaLayanan();
        
        // ============================================================
        // 4. MIGRASI FAQ
        // ============================================================
        $this->command->info('');
        $this->command->info('❓ Migrating FAQs...');
        $this->migrateFaq();
        
        // ============================================================
        // 5. MIGRASI TEAM
        // ============================================================
        $this->command->info('');
        $this->command->info('👥 Migrating team members...');
        $this->migrateTeam();
        
        // ============================================================
        // 6. MIGRASI HALAMAN STATIS
        // ============================================================
        $this->command->info('');
        $this->command->info('📄 Migrating static pages...');
        $this->migrateHalaman();
        
        // ============================================================
        // 7. MIGRASI PAKET LAYANAN
        // ============================================================
        $this->command->info('');
        $this->command->info('📦 Migrating service packages...');
        $this->migratePaketLayanan();
        
        // ============================================================
        // 8. MIGRASI PELANGGAN
        // ============================================================
        $this->command->info('');
        $this->command->info('👤 Migrating customers...');
        $this->migratePelanggan();
        
        // ============================================================
        // 9. MIGRASI KONSULTASI
        // ============================================================
        $this->command->info('');
        $this->command->info('💬 Migrating consultations...');
        $this->migrateKonsultasi();
        
        // ============================================================
        // 10. MIGRASI PROJECT
        // ============================================================
        $this->command->info('');
        $this->command->info('🏗️ Migrating projects...');
        $this->migrateProject();
        
        // ============================================================
        // 11. MIGRASI GALLERY PROJECT
        // ============================================================
        $this->command->info('');
        $this->command->info('🖼️ Migrating project galleries...');
        $this->migrateGalleryProject();
        
        // ============================================================
        // 12. MIGRASI MATERIAL PROJECT
        // ============================================================
        $this->command->info('');
        $this->command->info('🔧 Migrating project materials...');
        $this->migrateMaterialProject();
        
        // ============================================================
        // 13. MIGRASI TESTIMONI
        // ============================================================
        $this->command->info('');
        $this->command->info('⭐ Migrating testimonials...');
        $this->migrateTestimoni();
        
        // ============================================================
        // 14. MIGRASI ARTIKEL
        // ============================================================
        $this->command->info('');
        $this->command->info('📝 Migrating articles...');
        $this->migrateArtikel();
        
        // ============================================================
        // 15. MIGRASI SUBSCRIBER
        // ============================================================
        $this->command->info('');
        $this->command->info('📧 Migrating subscribers...');
        $this->migrateSubscriber();
        
        // ============================================================
        // 16. MIGRASI PESAN KONTAK
        // ============================================================
        $this->command->info('');
        $this->command->info('💌 Migrating contact messages...');
        $this->migratePesanKontak();
        
        // ============================================================
        // SELESAI
        // ============================================================
        $this->command->info('');
        $this->command->info('==========================================');
        $this->command->info('✅ Data migration completed successfully!');
        $this->command->info('==========================================');
    }
    
    /**
     * Migrate admin_users from old database
     */
    private function migrateAdminUsers(): void
    {
        try {
            $oldData = DB::connection('mysql_old')->table('admin_users')->get();
            $count = 0;
            $skipped = 0;
            
            foreach ($oldData as $data) {
                // Cek apakah sudah ada
                $exists = DB::table('admin_users')->where('username', $data->username)->exists();
                
                if (!$exists) {
                    DB::table('admin_users')->insert([
                        'id_admin' => $data->id_admin,
                        'username' => $data->username,
                        'password' => $data->password,
                        'nama_lengkap' => $data->nama_lengkap,
                        'email' => $data->email,
                        'role' => $data->role ?? 'admin',
                        'aktif' => $data->aktif ?? 1,
                        'approval_status' => $data->approval_status ?? 'approved',
                        'foto_profil' => $data->foto_profil ?? null,
                        'whatsapp' => $data->whatsapp ?? null,
                        'alamat' => $data->alamat ?? null,
                        'bio' => $data->bio ?? null,
                        'last_login' => $data->last_login ?? null,
                        'last_ip' => $data->last_ip ?? null,
                        'created_at' => $data->created_at ?? now(),
                        'updated_at' => $data->updated_at ?? now(),
                    ]);
                    $count++;
                } else {
                    $skipped++;
                }
            }
            
            $this->command->info("   ✅ Migrated: {$count} admin users (skipped: {$skipped})");
        } catch (\Exception $e) {
            $this->command->error("   ❌ Failed to migrate admin_users: " . $e->getMessage());
        }
    }
    
    /**
     * Migrate settings from old database
     */
    private function migrateSettings(): void
    {
        try {
            // Cek apakah tabel pengaturan_situs ada di database lama
            if (!Schema::connection('mysql_old')->hasTable('pengaturan_situs')) {
                $this->command->info("   ⚠️ Table 'pengaturan_situs' not found in old database, skipping...");
                return;
            }
            
            $oldData = DB::connection('mysql_old')->table('pengaturan_situs')->get();
            $count = 0;
            $skipped = 0;
            
            foreach ($oldData as $data) {
                $exists = DB::table('pengaturan_situs')->where('kunci', $data->kunci)->exists();
                
                if (!$exists) {
                    DB::table('pengaturan_situs')->insert([
                        'id_pengaturan' => $data->id_pengaturan,
                        'kategori' => $data->kategori ?? 'general',
                        'kunci' => $data->kunci,
                        'nilai' => $data->nilai ?? null,
                        'tipe' => $data->tipe ?? 'text',
                        'label' => $data->label ?? null,
                        'placeholder' => $data->placeholder ?? null,
                        'opsi' => $data->opsi ?? null,
                        'urutan' => $data->urutan ?? 0,
                        'created_at' => $data->created_at ?? now(),
                        'updated_at' => $data->updated_at ?? now(),
                    ]);
                    $count++;
                } else {
                    $skipped++;
                }
            }
            
            $this->command->info("   ✅ Migrated: {$count} settings (skipped: {$skipped})");
        } catch (\Exception $e) {
            $this->command->error("   ❌ Failed to migrate settings: " . $e->getMessage());
        }
    }
    
    /**
     * Migrate area_layanan from old database
     */
    private function migrateAreaLayanan(): void
    {
        try {
            if (!Schema::connection('mysql_old')->hasTable('area_layanan')) {
                $this->command->info("   ⚠️ Table 'area_layanan' not found in old database, skipping...");
                return;
            }
            
            $oldData = DB::connection('mysql_old')->table('area_layanan')->get();
            $count = 0;
            $skipped = 0;
            
            foreach ($oldData as $data) {
                $exists = DB::table('area_layanan')->where('nama_area', $data->nama_area)->exists();
                
                if (!$exists) {
                    DB::table('area_layanan')->insert([
                        'id_area' => $data->id_area,
                        'nama_area' => $data->nama_area,
                        'jenis_area' => $data->jenis_area ?? 'kota',
                        'daftar_lokasi' => $data->daftar_lokasi ?? null,
                        'deskripsi' => $data->deskripsi ?? null,
                        'aktif' => $data->aktif ?? 1,
                        'urutan' => $data->urutan ?? 0,
                        'created_at' => $data->created_at ?? now(),
                        'updated_at' => $data->updated_at ?? now(),
                    ]);
                    $count++;
                } else {
                    $skipped++;
                }
            }
            
            $this->command->info("   ✅ Migrated: {$count} service areas (skipped: {$skipped})");
        } catch (\Exception $e) {
            $this->command->error("   ❌ Failed to migrate area_layanan: " . $e->getMessage());
        }
    }
    
    /**
     * Migrate faq from old database
     */
    private function migrateFaq(): void
    {
        try {
            if (!Schema::connection('mysql_old')->hasTable('faq')) {
                $this->command->info("   ⚠️ Table 'faq' not found in old database, skipping...");
                return;
            }
            
            $oldData = DB::connection('mysql_old')->table('faq')->get();
            $count = 0;
            $skipped = 0;
            
            foreach ($oldData as $data) {
                $exists = DB::table('faq')->where('pertanyaan', $data->pertanyaan)->exists();
                
                if (!$exists) {
                    DB::table('faq')->insert([
                        'id_faq' => $data->id_faq,
                        'pertanyaan' => $data->pertanyaan,
                        'jawaban' => $data->jawaban,
                        'kategori' => $data->kategori ?? 'umum',
                        'urutan' => $data->urutan ?? 0,
                        'aktif' => $data->aktif ?? 1,
                        'created_at' => $data->created_at ?? now(),
                        'updated_at' => $data->updated_at ?? now(),
                    ]);
                    $count++;
                } else {
                    $skipped++;
                }
            }
            
            $this->command->info("   ✅ Migrated: {$count} FAQs (skipped: {$skipped})");
        } catch (\Exception $e) {
            $this->command->error("   ❌ Failed to migrate faq: " . $e->getMessage());
        }
    }
    
    /**
     * Migrate team from old database
     */
    private function migrateTeam(): void
    {
        try {
            if (!Schema::connection('mysql_old')->hasTable('team')) {
                $this->command->info("   ⚠️ Table 'team' not found in old database, skipping...");
                return;
            }
            
            $oldData = DB::connection('mysql_old')->table('team')->get();
            $count = 0;
            $skipped = 0;
            
            foreach ($oldData as $data) {
                $exists = DB::table('team')->where('nama_lengkap', $data->nama_lengkap)->exists();
                
                if (!$exists) {
                    DB::table('team')->insert([
                        'id_team' => $data->id_team,
                        'nama_lengkap' => $data->nama_lengkap,
                        'posisi' => $data->posisi,
                        'foto' => $data->foto ?? null,
                        'bio' => $data->bio ?? null,
                        'pengalaman' => $data->pengalaman ?? null,
                        'keahlian' => $data->keahlian ?? null,
                        'email' => $data->email ?? null,
                        'no_whatsapp' => $data->no_whatsapp ?? null,
                        'urutan' => $data->urutan ?? 0,
                        'aktif' => $data->aktif ?? 1,
                        'created_at' => $data->created_at ?? now(),
                        'updated_at' => $data->updated_at ?? now(),
                    ]);
                    $count++;
                } else {
                    $skipped++;
                }
            }
            
            $this->command->info("   ✅ Migrated: {$count} team members (skipped: {$skipped})");
        } catch (\Exception $e) {
            $this->command->error("   ❌ Failed to migrate team: " . $e->getMessage());
        }
    }
    
    /**
     * Migrate halaman from old database
     */
    private function migrateHalaman(): void
    {
        try {
            if (!Schema::connection('mysql_old')->hasTable('halaman')) {
                $this->command->info("   ⚠️ Table 'halaman' not found in old database, skipping...");
                return;
            }
            
            $oldData = DB::connection('mysql_old')->table('halaman')->get();
            $count = 0;
            $skipped = 0;
            
            foreach ($oldData as $data) {
                $exists = DB::table('halaman')->where('slug_halaman', $data->slug_halaman)->exists();
                
                if (!$exists) {
                    DB::table('halaman')->insert([
                        'id_halaman' => $data->id_halaman,
                        'judul_halaman' => $data->judul_halaman,
                        'slug_halaman' => $data->slug_halaman,
                        'konten' => $data->konten ?? null,
                        'jenis_halaman' => $data->jenis_halaman ?? 'lainnya',
                        'meta_title' => $data->meta_title ?? null,
                        'meta_description' => $data->meta_description ?? null,
                        'status_halaman' => $data->status_halaman ?? 'publish',
                        'urutan' => $data->urutan ?? 0,
                        'created_at' => $data->created_at ?? now(),
                        'updated_at' => $data->updated_at ?? now(),
                    ]);
                    $count++;
                } else {
                    $skipped++;
                }
            }
            
            $this->command->info("   ✅ Migrated: {$count} static pages (skipped: {$skipped})");
        } catch (\Exception $e) {
            $this->command->error("   ❌ Failed to migrate halaman: " . $e->getMessage());
        }
    }
    
    /**
     * Migrate paket_layanan from old database
     */
    private function migratePaketLayanan(): void
    {
        try {
            if (!Schema::connection('mysql_old')->hasTable('paket_layanan')) {
                $this->command->info("   ⚠️ Table 'paket_layanan' not found in old database, skipping...");
                return;
            }
            
            $oldData = DB::connection('mysql_old')->table('paket_layanan')->get();
            $count = 0;
            $skipped = 0;
            
            foreach ($oldData as $data) {
                $exists = DB::table('paket_layanan')->where('slug_paket', $data->slug_paket)->exists();
                
                if (!$exists) {
                    DB::table('paket_layanan')->insert([
                        'id_paket' => $data->id_paket,
                        'nama_paket' => $data->nama_paket,
                        'slug_paket' => $data->slug_paket,
                        'jenis_layanan' => $data->jenis_layanan,
                        'harga_mulai' => $data->harga_mulai,
                        'deskripsi_singkat' => $data->deskripsi_singkat ?? null,
                        'deskripsi_lengkap' => $data->deskripsi_lengkap ?? null,
                        'fitur' => $data->fitur ?? null,
                        'spesifikasi' => $data->spesifikasi ?? null,
                        'gambar_paket' => $data->gambar_paket ?? null,
                        'popular' => $data->popular ?? 0,
                        'urutan' => $data->urutan ?? 0,
                        'aktif' => $data->aktif ?? 1,
                        'created_at' => $data->created_at ?? now(),
                        'updated_at' => $data->updated_at ?? now(),
                    ]);
                    $count++;
                } else {
                    $skipped++;
                }
            }
            
            $this->command->info("   ✅ Migrated: {$count} service packages (skipped: {$skipped})");
        } catch (\Exception $e) {
            $this->command->error("   ❌ Failed to migrate paket_layanan: " . $e->getMessage());
        }
    }
    
    /**
     * Migrate pelanggan from old database
     */
    private function migratePelanggan(): void
    {
        try {
            if (!Schema::connection('mysql_old')->hasTable('pelanggan')) {
                $this->command->info("   ⚠️ Table 'pelanggan' not found in old database, skipping...");
                return;
            }
            
            $oldData = DB::connection('mysql_old')->table('pelanggan')->get();
            $count = 0;
            $skipped = 0;
            
            foreach ($oldData as $data) {
                $exists = DB::table('pelanggan')->where('no_whatsapp', $data->no_whatsapp)->exists();
                
                if (!$exists) {
                    DB::table('pelanggan')->insert([
                        'id_pelanggan' => $data->id_pelanggan,
                        'nama_lengkap' => $data->nama_lengkap,
                        'no_whatsapp' => $data->no_whatsapp,
                        'email' => $data->email ?? null,
                        'alamat' => $data->alamat ?? null,
                        'status_pelanggan' => $data->status_pelanggan ?? 'prospek',
                        'sumber' => $data->sumber ?? 'website',
                        'catatan' => $data->catatan ?? null,
                        'tanggal_daftar' => $data->tanggal_daftar ?? now(),
                        'created_at' => $data->created_at ?? now(),
                        'updated_at' => $data->updated_at ?? now(),
                    ]);
                    $count++;
                } else {
                    $skipped++;
                }
            }
            
            $this->command->info("   ✅ Migrated: {$count} customers (skipped: {$skipped})");
        } catch (\Exception $e) {
            $this->command->error("   ❌ Failed to migrate pelanggan: " . $e->getMessage());
        }
    }
    
    /**
     * Migrate konsultasi from old database
     */
    private function migrateKonsultasi(): void
    {
        try {
            if (!Schema::connection('mysql_old')->hasTable('konsultasi')) {
                $this->command->info("   ⚠️ Table 'konsultasi' not found in old database, skipping...");
                return;
            }
            
            $oldData = DB::connection('mysql_old')->table('konsultasi')->get();
            $count = 0;
            $skipped = 0;
            
            foreach ($oldData as $data) {
                $exists = DB::table('konsultasi')->where('no_whatsapp', $data->no_whatsapp)
                    ->where('created_at', $data->created_at)
                    ->exists();
                
                if (!$exists) {
                    DB::table('konsultasi')->insert([
                        'id_konsultasi' => $data->id_konsultasi,
                        'id_pelanggan' => $data->id_pelanggan ?? null,
                        'nama_konsultan' => $data->nama_konsultan ?? null,
                        'no_whatsapp' => $data->no_whatsapp,
                        'email' => $data->email ?? null,
                        'jenis_layanan' => $data->jenis_layanan,
                        'budget' => $data->budget,
                        'ukuran_dapur' => $data->ukuran_dapur ?? null,
                        'alamat_lokasi' => $data->alamat_lokasi ?? null,
                        'pesan_kebutuhan' => $data->pesan_kebutuhan ?? null,
                        'status_konsultasi' => $data->status_konsultasi ?? 'baru',
                        'dihubungi' => $data->dihubungi ?? 'belum',
                        'jadwal_survey' => $data->jadwal_survey ?? null,
                        'catatan_admin' => $data->catatan_admin ?? null,
                        'tanggal_konsultasi' => $data->tanggal_konsultasi ?? now(),
                        'created_at' => $data->created_at ?? now(),
                        'updated_at' => $data->updated_at ?? now(),
                    ]);
                    $count++;
                } else {
                    $skipped++;
                }
            }
            
            $this->command->info("   ✅ Migrated: {$count} consultations (skipped: {$skipped})");
        } catch (\Exception $e) {
            $this->command->error("   ❌ Failed to migrate konsultasi: " . $e->getMessage());
        }
    }
    
    /**
     * Migrate project from old database
     */
    private function migrateProject(): void
    {
        try {
            if (!Schema::connection('mysql_old')->hasTable('project')) {
                $this->command->info("   ⚠️ Table 'project' not found in old database, skipping...");
                return;
            }
            
            $oldData = DB::connection('mysql_old')->table('project')->get();
            $count = 0;
            $skipped = 0;
            
            foreach ($oldData as $data) {
                $exists = DB::table('project')->where('kode_project', $data->kode_project)->exists();
                
                if (!$exists) {
                    DB::table('project')->insert([
                        'id_project' => $data->id_project,
                        'id_pelanggan' => $data->id_pelanggan,
                        'id_konsultasi' => $data->id_konsultasi ?? null,
                        'kode_project' => $data->kode_project,
                        'nama_project' => $data->nama_project,
                        'jenis_project' => $data->jenis_project,
                        'kategori_desain' => $data->kategori_desain,
                        'luas_area' => $data->luas_area,
                        'lokasi_project' => $data->lokasi_project,
                        'alamat_lengkap' => $data->alamat_lengkap ?? null,
                        'budget_project' => $data->budget_project,
                        'biaya_actual' => $data->biaya_actual ?? null,
                        'durasi_pengerjaan' => $data->durasi_pengerjaan ?? null,
                        'deskripsi_project' => $data->deskripsi_project ?? null,
                        'testimoni_client' => $data->testimoni_client ?? null,
                        'rating_project' => $data->rating_project ?? null,
                        'status_project' => $data->status_project ?? 'desain',
                        'tanggal_mulai' => $data->tanggal_mulai ?? null,
                        'tanggal_selesai' => $data->tanggal_selesai ?? null,
                        'tanggal_garansi' => $data->tanggal_garansi ?? null,
                        'created_at' => $data->created_at ?? now(),
                        'updated_at' => $data->updated_at ?? now(),
                    ]);
                    $count++;
                } else {
                    $skipped++;
                }
            }
            
            $this->command->info("   ✅ Migrated: {$count} projects (skipped: {$skipped})");
        } catch (\Exception $e) {
            $this->command->error("   ❌ Failed to migrate project: " . $e->getMessage());
        }
    }
    
    /**
     * Migrate gallery_project from old database
     */
    private function migrateGalleryProject(): void
    {
        try {
            if (!Schema::connection('mysql_old')->hasTable('gallery_project')) {
                $this->command->info("   ⚠️ Table 'gallery_project' not found in old database, skipping...");
                return;
            }
            
            $oldData = DB::connection('mysql_old')->table('gallery_project')->get();
            $count = 0;
            $skipped = 0;
            
            foreach ($oldData as $data) {
                $exists = DB::table('gallery_project')->where('id_project', $data->id_project)
                    ->where('nama_file', $data->nama_file)
                    ->exists();
                
                if (!$exists) {
                    DB::table('gallery_project')->insert([
                        'id_gallery' => $data->id_gallery,
                        'id_project' => $data->id_project,
                        'jenis_foto' => $data->jenis_foto,
                        'nama_file' => $data->nama_file,
                        'url_foto' => $data->url_foto,
                        'deskripsi_foto' => $data->deskripsi_foto ?? null,
                        'thumbnail' => $data->thumbnail ?? 0,
                        'urutan' => $data->urutan ?? 0,
                        'created_at' => $data->created_at ?? now(),
                        'updated_at' => $data->updated_at ?? now(),
                    ]);
                    $count++;
                } else {
                    $skipped++;
                }
            }
            
            $this->command->info("   ✅ Migrated: {$count} galleries (skipped: {$skipped})");
        } catch (\Exception $e) {
            $this->command->error("   ❌ Failed to migrate gallery_project: " . $e->getMessage());
        }
    }
    
    /**
     * Migrate material_project from old database
     */
    private function migrateMaterialProject(): void
    {
        try {
            if (!Schema::connection('mysql_old')->hasTable('material_project')) {
                $this->command->info("   ⚠️ Table 'material_project' not found in old database, skipping...");
                return;
            }
            
            $oldData = DB::connection('mysql_old')->table('material_project')->get();
            $count = 0;
            $skipped = 0;
            
            foreach ($oldData as $data) {
                $exists = DB::table('material_project')->where('id_project', $data->id_project)
                    ->where('nama_material', $data->nama_material)
                    ->exists();
                
                if (!$exists) {
                    DB::table('material_project')->insert([
                        'id_material' => $data->id_material,
                        'id_project' => $data->id_project,
                        'nama_material' => $data->nama_material,
                        'jenis_material' => $data->jenis_material,
                        'spesifikasi' => $data->spesifikasi ?? null,
                        'merk' => $data->merk ?? null,
                        'jumlah' => $data->jumlah ?? 1,
                        'satuan' => $data->satuan ?? null,
                        'created_at' => $data->created_at ?? now(),
                        'updated_at' => $data->updated_at ?? now(),
                    ]);
                    $count++;
                } else {
                    $skipped++;
                }
            }
            
            $this->command->info("   ✅ Migrated: {$count} materials (skipped: {$skipped})");
        } catch (\Exception $e) {
            $this->command->error("   ❌ Failed to migrate material_project: " . $e->getMessage());
        }
    }
    
    /**
     * Migrate testimoni from old database
     */
    private function migrateTestimoni(): void
    {
        try {
            if (!Schema::connection('mysql_old')->hasTable('testimoni')) {
                $this->command->info("   ⚠️ Table 'testimoni' not found in old database, skipping...");
                return;
            }
            
            $oldData = DB::connection('mysql_old')->table('testimoni')->get();
            $count = 0;
            $skipped = 0;
            
            foreach ($oldData as $data) {
                $exists = DB::table('testimoni')->where('nama_client', $data->nama_client)
                    ->where('testimoni', $data->testimoni)
                    ->exists();
                
                if (!$exists) {
                    DB::table('testimoni')->insert([
                        'id_testimoni' => $data->id_testimoni,
                        'id_project' => $data->id_project ?? null,
                        'nama_client' => $data->nama_client,
                        'foto_client' => $data->foto_client ?? null,
                        'url_video' => $data->url_video ?? null,
                        'video_platform' => $data->video_platform ?? null,
                        'video_id' => $data->video_id ?? null,
                        'video_thumbnail' => $data->video_thumbnail ?? null,
                        'rating' => $data->rating,
                        'testimoni' => $data->testimoni,
                        'jenis_project' => $data->jenis_project ?? null,
                        'lokasi' => $data->lokasi ?? null,
                        'status_testimoni' => $data->status_testimoni ?? 'approved',
                        'tipe_testimoni' => $data->tipe_testimoni ?? 'teks',
                        'featured' => $data->featured ?? 0,
                        'tanggal_testimoni' => $data->tanggal_testimoni ?? null,
                        'created_at' => $data->created_at ?? now(),
                        'updated_at' => $data->updated_at ?? now(),
                    ]);
                    $count++;
                } else {
                    $skipped++;
                }
            }
            
            $this->command->info("   ✅ Migrated: {$count} testimonials (skipped: {$skipped})");
        } catch (\Exception $e) {
            $this->command->error("   ❌ Failed to migrate testimoni: " . $e->getMessage());
        }
    }
    
    /**
     * Migrate artikel from old database
     */
    private function migrateArtikel(): void
    {
        try {
            if (!Schema::connection('mysql_old')->hasTable('artikel')) {
                $this->command->info("   ⚠️ Table 'artikel' not found in old database, skipping...");
                return;
            }
            
            $oldData = DB::connection('mysql_old')->table('artikel')->get();
            $count = 0;
            $skipped = 0;
            
            foreach ($oldData as $data) {
                $exists = DB::table('artikel')->where('slug', $data->slug)->exists();
                
                if (!$exists) {
                    DB::table('artikel')->insert([
                        'id_artikel' => $data->id_artikel,
                        'judul_artikel' => $data->judul_artikel,
                        'slug' => $data->slug,
                        'konten' => $data->konten,
                        'excerpt' => $data->excerpt ?? null,
                        'gambar_utama' => $data->gambar_utama ?? null,
                        'kategori' => $data->kategori,
                        'tags' => $data->tags ?? null,
                        'penulis' => $data->penulis ?? 'Admin Bogorior',
                        'status_artikel' => $data->status_artikel ?? 'publish',
                        'featured' => $data->featured ?? 0,
                        'tanggal_publish' => $data->tanggal_publish ?? now(),
                        'views' => $data->views ?? 0,
                        'meta_title' => $data->meta_title ?? null,
                        'meta_description' => $data->meta_description ?? null,
                        'created_at' => $data->created_at ?? now(),
                        'updated_at' => $data->updated_at ?? now(),
                    ]);
                    $count++;
                } else {
                    $skipped++;
                }
            }
            
            $this->command->info("   ✅ Migrated: {$count} articles (skipped: {$skipped})");
        } catch (\Exception $e) {
            $this->command->error("   ❌ Failed to migrate artikel: " . $e->getMessage());
        }
    }
    
    /**
     * Migrate subscriber from old database
     */
    private function migrateSubscriber(): void
    {
        try {
            if (!Schema::connection('mysql_old')->hasTable('subscriber')) {
                $this->command->info("   ⚠️ Table 'subscriber' not found in old database, skipping...");
                return;
            }
            
            $oldData = DB::connection('mysql_old')->table('subscriber')->get();
            $count = 0;
            $skipped = 0;
            
            foreach ($oldData as $data) {
                $exists = DB::table('subscriber')->where('email', $data->email)->exists();
                
                if (!$exists) {
                    DB::table('subscriber')->insert([
                        'id_subscriber' => $data->id_subscriber,
                        'email' => $data->email,
                        'nama' => $data->nama ?? null,
                        'status' => $data->status ?? 'aktif',
                        'tanggal_subscribe' => $data->tanggal_subscribe ?? now(),
                        'terakhir_kirim' => $data->terakhir_kirim ?? null,
                        'token_unsubscribe' => $data->token_unsubscribe ?? md5($data->email . time()),
                        'created_at' => $data->created_at ?? now(),
                        'updated_at' => $data->updated_at ?? now(),
                    ]);
                    $count++;
                } else {
                    $skipped++;
                }
            }
            
            $this->command->info("   ✅ Migrated: {$count} subscribers (skipped: {$skipped})");
        } catch (\Exception $e) {
            $this->command->error("   ❌ Failed to migrate subscriber: " . $e->getMessage());
        }
    }
    
    /**
     * Migrate pesan_kontak from old database
     */
    private function migratePesanKontak(): void
    {
        try {
            if (!Schema::connection('mysql_old')->hasTable('pesan_kontak')) {
                $this->command->info("   ⚠️ Table 'pesan_kontak' not found in old database, skipping...");
                return;
            }
            
            $oldData = DB::connection('mysql_old')->table('pesan_kontak')->get();
            $count = 0;
            $skipped = 0;
            
            foreach ($oldData as $data) {
                $exists = DB::table('pesan_kontak')->where('email_pengirim', $data->email_pengirim)
                    ->where('subjek', $data->subjek)
                    ->exists();
                
                if (!$exists) {
                    DB::table('pesan_kontak')->insert([
                        'id_pesan' => $data->id_pesan,
                        'nama_pengirim' => $data->nama_pengirim,
                        'email_pengirim' => $data->email_pengirim,
                        'no_whatsapp' => $data->no_whatsapp ?? null,
                        'subjek' => $data->subjek,
                        'pesan' => $data->pesan,
                        'status_pesan' => $data->status_pesan ?? 'baru',
                        'dibaca_pada' => $data->dibaca_pada ?? null,
                        'dibalas_pada' => $data->dibalas_pada ?? null,
                        'created_at' => $data->created_at ?? now(),
                        'updated_at' => $data->updated_at ?? now(),
                    ]);
                    $count++;
                } else {
                    $skipped++;
                }
            }
            
            $this->command->info("   ✅ Migrated: {$count} contact messages (skipped: {$skipped})");
        } catch (\Exception $e) {
            $this->command->error("   ❌ Failed to migrate pesan_kontak: " . $e->getMessage());
        }
    }
}