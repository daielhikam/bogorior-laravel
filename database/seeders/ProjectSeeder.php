<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        
        $projects = [
            [
                'id_pelanggan' => 1,
                'kode_project' => 'KS2024-0001',
                'nama_project' => 'Kitchen Set Modern Minimalis Bogor',
                'jenis_project' => 'custom',
                'kategori_desain' => 'minimalist',
                'luas_area' => 12.00,
                'lokasi_project' => 'Bogor',
                'budget_project' => 25000000,
                'status_project' => 'selesai',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_pelanggan' => 2,
                'kode_project' => 'KS2024-0002',
                'nama_project' => 'Renovasi Dapur Jakarta Selatan',
                'jenis_project' => 'renovasi',
                'kategori_desain' => 'modern',
                'luas_area' => 20.00,
                'lokasi_project' => 'Jakarta Selatan',
                'budget_project' => 45000000,
                'status_project' => 'selesai',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_pelanggan' => 3,
                'kode_project' => 'KS2024-0003',
                'nama_project' => 'Kitchen Set Premium Depok',
                'jenis_project' => 'premium',
                'kategori_desain' => 'luxury',
                'luas_area' => 15.00,
                'lokasi_project' => 'Depok',
                'budget_project' => 75000000,
                'status_project' => 'selesai',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        foreach ($projects as $project) {
            DB::table('project')->insert($project);
        }

        $this->command->info('✅ Projects seeded: ' . count($projects) . ' projects');
    }
}