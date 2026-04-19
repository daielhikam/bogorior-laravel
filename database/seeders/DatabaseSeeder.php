<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->command->info('==========================================');
        $this->command->info('🌱 Starting Bogorior KitchenSet Seeder');
        $this->command->info('==========================================');
        
        // Basic tables
        $this->call(AdminUserSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(AreaLayananSeeder::class);
        $this->call(FaqSeeder::class);
        $this->call(TeamSeeder::class);
        $this->call(HalamanSeeder::class);
        $this->call(PaketLayananSeeder::class);
        
        // Customers and consultations
        $this->call(PelangganSeeder::class);
        $this->call(KonsultasiSeeder::class);
        
        // Projects and related
        $this->call(ProjectSeeder::class);
        $this->call(GalleryProjectSeeder::class);
        $this->call(MaterialProjectSeeder::class);
        $this->call(TestimoniSeeder::class);
        
        // Articles and subscribers
        $this->call(ArtikelSeeder::class);
        $this->call(SubscriberSeeder::class);
        $this->call(PesanKontakSeeder::class);
        
        // Logs and activities
        $this->call(AktivitasAdminSeeder::class);
        $this->call(NotifikasiAdminSeeder::class);
        $this->call(ApprovalLogSeeder::class);
        
        $this->command->info('==========================================');
        $this->command->info('✅ All seeders completed successfully!');
        $this->command->info('==========================================');
    }
}