<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        
        $teams = [
            ['nama_lengkap' => 'Mass El', 'posisi' => 'Lead Desainer & Founder', 'pengalaman' => '10+ tahun', 'keahlian' => "Desain Modern & Minimalis\n3D Modeling", 'email' => 'massel@bogorior.com', 'urutan' => 1],
            ['nama_lengkap' => 'Sarah Wijaya', 'posisi' => 'Senior Desainer', 'pengalaman' => '8+ tahun', 'keahlian' => "Desain Kontemporer\nColor Theory", 'email' => 'sarah@bogorior.com', 'urutan' => 2],
            ['nama_lengkap' => 'Budi Hartono', 'posisi' => 'Project Manager', 'pengalaman' => '6+ tahun', 'keahlian' => "Project Management\nQuality Control", 'email' => 'budi@bogorior.com', 'urutan' => 3],
            ['nama_lengkap' => 'Dewi Lestari', 'posisi' => 'Desainer Interior', 'pengalaman' => '5+ tahun', 'keahlian' => "Desain Klasik Modern\n3D Visualization", 'email' => 'dewi@bogorior.com', 'urutan' => 4],
            ['nama_lengkap' => 'Andi Saputra', 'posisi' => 'Teknisi Senior', 'pengalaman' => '12+ tahun', 'keahlian' => "Instalasi Kitchen Set\nQuality Control", 'email' => 'andi@bogorior.com', 'urutan' => 5],
        ];

        foreach ($teams as $team) {
            DB::table('team')->insert([
                'nama_lengkap' => $team['nama_lengkap'],
                'posisi' => $team['posisi'],
                'pengalaman' => $team['pengalaman'],
                'keahlian' => $team['keahlian'],
                'email' => $team['email'],
                'urutan' => $team['urutan'],
                'aktif' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $this->command->info('✅ Team members seeded: ' . count($teams) . ' members');
    }
}