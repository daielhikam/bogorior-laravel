<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run(): void
    {
        $now = now();
        
        $teams = [
            [
                'nama_lengkap' => 'Mass El',
                'posisi' => 'Lead Desainer & Founder',
                'foto' => null,
                'bio' => 'Mass El adalah pendiri Bogorior KitchenSet dengan pengalaman lebih dari 10 tahun di industri desain interior. Beliau memiliki passion untuk menciptakan dapur yang tidak hanya fungsional tetapi juga estetis.',
                'pengalaman' => '10+ tahun',
                'keahlian' => "Desain Modern & Minimalis\n3D Modeling\nProject Management",
                'email' => 'massel@bogorior.com',
                'no_whatsapp' => '628977288600',
                'urutan' => 1,
                'aktif' => 1,
            ],
            [
                'nama_lengkap' => 'Sarah Wijaya',
                'posisi' => 'Senior Desainer',
                'foto' => null,
                'bio' => 'Sarah adalah desainer senior yang ahli dalam menciptakan dapur impian dengan sentuhan modern dan fungsional. Beliau telah menangani lebih dari 200 proyek kitchen set.',
                'pengalaman' => '8+ tahun',
                'keahlian' => "Desain Kontemporer\nColor Theory\nSpace Planning",
                'email' => 'sarah@bogorior.com',
                'no_whatsapp' => '628977288601',
                'urutan' => 2,
                'aktif' => 1,
            ],
            [
                'nama_lengkap' => 'Budi Hartono',
                'posisi' => 'Project Manager',
                'foto' => null,
                'bio' => 'Budi bertanggung jawab mengawasi seluruh proses dari desain hingga instalasi. Memastikan setiap proyek selesai tepat waktu dan sesuai standar kualitas.',
                'pengalaman' => '6+ tahun',
                'keahlian' => "Project Management\nQuality Control\nTim Koordinasi",
                'email' => 'budi@bogorior.com',
                'no_whatsapp' => '628977288602',
                'urutan' => 3,
                'aktif' => 1,
            ],
            [
                'nama_lengkap' => 'Dewi Lestari',
                'posisi' => 'Desainer Interior',
                'foto' => null,
                'bio' => 'Dewi memiliki keahlian dalam menciptakan desain yang memadukan estetika dan fungsionalitas. Beliau selalu update dengan tren desain terbaru.',
                'pengalaman' => '5+ tahun',
                'keahlian' => "Desain Klasik Modern\n3D Visualization\nMaterial Selection",
                'email' => 'dewi@bogorior.com',
                'no_whatsapp' => '628977288603',
                'urutan' => 4,
                'aktif' => 1,
            ],
            [
                'nama_lengkap' => 'Andi Saputra',
                'posisi' => 'Teknisi Senior',
                'foto' => null,
                'bio' => 'Andi adalah teknisi senior yang berpengalaman dalam instalasi kitchen set. Memastikan setiap pemasangan dilakukan dengan presisi tinggi.',
                'pengalaman' => '12+ tahun',
                'keahlian' => "Instalasi Kitchen Set\nPerbaikan & Maintenance\nQuality Control",
                'email' => 'andi@bogorior.com',
                'no_whatsapp' => '628977288604',
                'urutan' => 5,
                'aktif' => 1,
            ],
        ];

        foreach ($teams as $team) {
            DB::table('team')->insert([
                'nama_lengkap' => $team['nama_lengkap'],
                'posisi' => $team['posisi'],
                'foto' => $team['foto'],
                'bio' => $team['bio'],
                'pengalaman' => $team['pengalaman'],
                'keahlian' => $team['keahlian'],
                'email' => $team['email'],
                'no_whatsapp' => $team['no_whatsapp'],
                'urutan' => $team['urutan'],
                'aktif' => $team['aktif'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $this->command->info('✅ Team members seeded: ' . count($teams) . ' members');
    }
}