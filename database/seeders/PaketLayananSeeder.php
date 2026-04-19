<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaketLayananSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        
        $packages = [
            ['nama_paket' => 'Kitchen Set Custom', 'slug_paket' => 'kitchen-set-custom', 'jenis_layanan' => 'custom', 'harga_mulai' => 8500000, 'deskripsi_singkat' => 'Desain sesuai keinginan Anda', 'popular' => 1, 'urutan' => 1],
            ['nama_paket' => 'Kitchen Set Premium', 'slug_paket' => 'kitchen-set-premium', 'jenis_layanan' => 'premium', 'harga_mulai' => 15000000, 'deskripsi_singkat' => 'Material import kualitas terbaik', 'popular' => 1, 'urutan' => 2],
            ['nama_paket' => 'Renovasi Dapur', 'slug_paket' => 'renovasi-dapur', 'jenis_layanan' => 'renovasi', 'harga_mulai' => 5000000, 'deskripsi_singkat' => 'Perbaharui tampilan dapur Anda', 'urutan' => 3],
            ['nama_paket' => 'Interior Design', 'slug_paket' => 'interior-design', 'jenis_layanan' => 'interior', 'harga_mulai' => 25000000, 'deskripsi_singkat' => 'Desain interior lengkap', 'urutan' => 4],
        ];

        foreach ($packages as $package) {
            DB::table('paket_layanan')->insert([
                'nama_paket' => $package['nama_paket'],
                'slug_paket' => $package['slug_paket'],
                'jenis_layanan' => $package['jenis_layanan'],
                'harga_mulai' => $package['harga_mulai'],
                'deskripsi_singkat' => $package['deskripsi_singkat'],
                'popular' => $package['popular'] ?? 0,
                'urutan' => $package['urutan'],
                'aktif' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $this->command->info('✅ Service packages seeded: ' . count($packages) . ' packages');
    }
}