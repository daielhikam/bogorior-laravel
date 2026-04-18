<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     * 
     * Urutan seeders harus berdasarkan dependency (tabel parent di-seed terlebih dahulu)
     */
    public function run(): void
    {
        $this->command->info('==========================================');
        $this->command->info('🌱 Starting Bogorior KitchenSet Seeder');
        $this->command->info('==========================================');
        
        // ============================================================
        // 1. TABEL DASAR (TIDAK MEMILIKI DEPENDENCY)
        // ============================================================
        $this->command->info('');
        $this->command->info('📦 Seeding basic tables...');
        
        // Admin Users (Super Admin, Admin, dll)
        $this->call(AdminUserSeeder::class);
        
        // Settings (Pengaturan Situs)
        $this->call(SettingSeeder::class);
        
        // Service Areas (Area Layanan)
        $this->call(AreaLayananSeeder::class);
        
        // FAQ
        $this->call(FaqSeeder::class);
        
        // Team Members
        $this->call(TeamSeeder::class);
        
        // Static Pages (Halaman)
        $this->call(HalamanSeeder::class);
        
        // Service Packages (Paket Layanan)
        $this->call(PaketLayananSeeder::class);
        
        // ============================================================
        // 2. TABEL CUSTOMER & CONSULTATION
        // ============================================================
        $this->command->info('');
        $this->command->info('👥 Seeding customers and consultations...');
        
        // Pelanggan (Customers)
        $this->call(PelangganSeeder::class);
        
        // Konsultasi
        $this->call(KonsultasiSeeder::class);
        
        // ============================================================
        // 3. TABEL PROJECT & RELATED
        // ============================================================
        $this->command->info('');
        $this->command->info('🏗️ Seeding projects and related data...');
        
        // Projects
        $this->call(ProjectSeeder::class);
        
        // Gallery Project
        $this->call(GalleryProjectSeeder::class);
        
        // Material Project
        $this->call(MaterialProjectSeeder::class);
        
        // Testimonials
        $this->call(TestimoniSeeder::class);
        
        // ============================================================
        // 4. TABEL ARTICLES & SUBSCRIBERS
        // ============================================================
        $this->command->info('');
        $this->command->info('📝 Seeding articles and subscribers...');
        
        // Articles (Blog)
        $this->call(ArtikelSeeder::class);
        
        // Subscribers
        $this->call(SubscriberSeeder::class);
        
        // Contact Messages
        $this->call(PesanKontakSeeder::class);
        
        // ============================================================
        // 5. TABEL LOGS & ACTIVITIES (OPSIONAL)
        // ============================================================
        $this->command->info('');
        $this->command->info('📋 Seeding logs and activities...');
        
        // Aktivitas Admin
        $this->call(AktivitasAdminSeeder::class);
        
        // Notifikasi Admin
        $this->call(NotifikasiAdminSeeder::class);
        
        // Approval Logs
        $this->call(ApprovalLogSeeder::class);
        
        // ============================================================
        // 6. SELESAI
        // ============================================================
        $this->command->info('');
        $this->command->info('==========================================');
        $this->command->info('✅ All seeders completed successfully!');
        $this->command->info('==========================================');
    }
}