<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HalamanSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        
        $pages = [
            [
                'judul_halaman' => 'Tentang Kami',
                'slug_halaman' => 'tentang-kami',
                'konten' => '<h2>Bogorior KitchenSet</h2><p>Spesialis kitchen set di Bogor dengan pengalaman lebih dari 10 tahun.</p>',
                'jenis_halaman' => 'tentang',
                'status_halaman' => 'publish',
                'urutan' => 1,
            ],
            [
                'judul_halaman' => 'Kontak Kami',
                'slug_halaman' => 'kontak-kami',
                'konten' => '<h2>Hubungi Kami</h2><p>Tim kami siap membantu Anda mewujudkan dapur impian.</p>',
                'jenis_halaman' => 'kontak',
                'status_halaman' => 'publish',
                'urutan' => 2,
            ],
        ];

        foreach ($pages as $page) {
            DB::table('halaman')->insert([
                'judul_halaman' => $page['judul_halaman'],
                'slug_halaman' => $page['slug_halaman'],
                'konten' => $page['konten'],
                'jenis_halaman' => $page['jenis_halaman'],
                'status_halaman' => $page['status_halaman'],
                'urutan' => $page['urutan'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $this->command->info('✅ Static pages seeded: ' . count($pages) . ' pages');
    }
}