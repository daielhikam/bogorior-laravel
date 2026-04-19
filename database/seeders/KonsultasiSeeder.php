<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KonsultasiSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        
        $consultations = [
            ['id_pelanggan' => 1, 'nama_konsultan' => 'Budi Santoso', 'no_whatsapp' => '628123456789', 'email' => 'budi@email.com', 'jenis_layanan' => 'custom', 'budget' => '20-35', 'status_konsultasi' => 'selesai', 'dihubungi' => 'ya'],
            ['id_pelanggan' => 2, 'nama_konsultan' => 'Sari Dewi', 'no_whatsapp' => '628987654321', 'email' => 'sari@email.com', 'jenis_layanan' => 'premium', 'budget' => '35-50', 'status_konsultasi' => 'diproses', 'dihubungi' => 'ya'],
            ['id_pelanggan' => 3, 'nama_konsultan' => 'Rudi Hartono', 'no_whatsapp' => '628555666777', 'email' => 'rudi@email.com', 'jenis_layanan' => 'renovasi', 'budget' => '10-20', 'status_konsultasi' => 'selesai', 'dihubungi' => 'ya'],
        ];

        foreach ($consultations as $consultation) {
            DB::table('konsultasi')->insert([
                'id_pelanggan' => $consultation['id_pelanggan'],
                'nama_konsultan' => $consultation['nama_konsultan'],
                'no_whatsapp' => $consultation['no_whatsapp'],
                'email' => $consultation['email'],
                'jenis_layanan' => $consultation['jenis_layanan'],
                'budget' => $consultation['budget'],
                'status_konsultasi' => $consultation['status_konsultasi'],
                'dihubungi' => $consultation['dihubungi'],
                'tanggal_konsultasi' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $this->command->info('✅ Consultations seeded: ' . count($consultations) . ' consultations');
    }
}