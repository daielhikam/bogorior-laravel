<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelangganSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        
        $customers = [
            ['nama_lengkap' => 'Budi Santoso', 'no_whatsapp' => '628123456789', 'email' => 'budi@email.com', 'alamat' => 'Jl. Merdeka No. 1, Bogor', 'status_pelanggan' => 'klien', 'sumber' => 'website'],
            ['nama_lengkap' => 'Sari Dewi', 'no_whatsapp' => '628987654321', 'email' => 'sari@email.com', 'alamat' => 'Jl. Sudirman No. 45, Jakarta', 'status_pelanggan' => 'prospek', 'sumber' => 'instagram'],
            ['nama_lengkap' => 'Rudi Hartono', 'no_whatsapp' => '628555666777', 'email' => 'rudi@email.com', 'alamat' => 'Jl. Gatot Subroto No. 67, Depok', 'status_pelanggan' => 'selesai', 'sumber' => 'referensi'],
        ];

        foreach ($customers as $customer) {
            DB::table('pelanggan')->insert([
                'nama_lengkap' => $customer['nama_lengkap'],
                'no_whatsapp' => $customer['no_whatsapp'],
                'email' => $customer['email'],
                'alamat' => $customer['alamat'],
                'status_pelanggan' => $customer['status_pelanggan'],
                'sumber' => $customer['sumber'],
                'tanggal_daftar' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $this->command->info('✅ Customers seeded: ' . count($customers) . ' customers');
    }
}
