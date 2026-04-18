<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelangganSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run(): void
    {
        $now = now();
        
        $customers = [
            [
                'nama_lengkap' => 'Budi Santoso',
                'no_whatsapp' => '628123456789',
                'email' => 'budi@email.com',
                'alamat' => 'Jl. Merdeka No. 1, Bogor',
                'status_pelanggan' => 'klien',
                'sumber' => 'website',
                'catatan' => 'Klien pertama, project kitchen set custom',
                'tanggal_daftar' => $now,
                'created_at' => $now,
            ],
            [
                'nama_lengkap' => 'Sari Dewi',
                'no_whatsapp' => '628987654321',
                'email' => 'sari@email.com',
                'alamat' => 'Jl. Sudirman No. 45, Jakarta',
                'status_pelanggan' => 'prospek',
                'sumber' => 'instagram',
                'catatan' => 'Tertarik dengan kitchen set premium',
                'tanggal_daftar' => $now,
                'created_at' => $now,
            ],
            [
                'nama_lengkap' => 'Rudi Hartono',
                'no_whatsapp' => '628555666777',
                'email' => 'rudi@email.com',
                'alamat' => 'Jl. Gatot Subroto No. 67, Depok',
                'status_pelanggan' => 'selesai',
                'sumber' => 'referensi',
                'catatan' => 'Project renovasi dapur selesai',
                'tanggal_daftar' => $now,
                'created_at' => $now,
            ],
            [
                'nama_lengkap' => 'Diana Putri',
                'no_whatsapp' => '628777888999',
                'email' => 'diana@email.com',
                'alamat' => 'Jl. Pajajaran No. 23, Bogor',
                'status_pelanggan' => 'klien',
                'sumber' => 'facebook',
                'catatan' => 'Project kitchen set modern',
                'tanggal_daftar' => $now,
                'created_at' => $now,
            ],
            [
                'nama_lengkap' => 'Andi Wijaya',
                'no_whatsapp' => '628999888777',
                'email' => 'andi@email.com',
                'alamat' => 'Jl. Raya Bogor KM 35, Jakarta Timur',
                'status_pelanggan' => 'prospek',
                'sumber' => 'tiktok',
                'catatan' => 'Minta info kitchen set minimalis',
                'tanggal_daftar' => $now,
                'created_at' => $now,
            ],
        ];

        foreach ($customers as $customer) {
            DB::table('pelanggan')->insert($customer);
        }

        $this->command->info('✅ Customers seeded: ' . count($customers) . ' customers');
    }
} 