<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PesanKontakSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run(): void
    {
        $now = now();
        
        $messages = [
            [
                'nama_pengirim' => 'Andi Pratama',
                'email_pengirim' => 'andi@email.com',
                'no_whatsapp' => '628123456789',
                'subjek' => 'Konsultasi Kitchen Set',
                'pesan' => 'Saya tertarik dengan kitchen set custom. Bisa konsultasi? Mohon infonya.',
                'status_pesan' => 'dibalas',
                'dibaca_pada' => $now->copy()->subDays(5),
                'dibalas_pada' => $now->copy()->subDays(4),
                'created_at' => $now->copy()->subDays(6),
            ],
            [
                'nama_pengirim' => 'Rina Wijaya',
                'email_pengirim' => 'rina@email.com',
                'no_whatsapp' => '628987654321',
                'subjek' => 'Request Katalog Produk',
                'pesan' => 'Mohon dikirimkan katalog produk kitchen set terbaru beserta daftar harganya. Terima kasih.',
                'status_pesan' => 'dibaca',
                'dibaca_pada' => $now->copy()->subDays(2),
                'dibalas_pada' => null,
                'created_at' => $now->copy()->subDays(3),
            ],
            [
                'nama_pengirim' => 'Bambang Susilo',
                'email_pengirim' => 'bambang@email.com',
                'no_whatsapp' => '628555666777',
                'subjek' => 'Info Garansi',
                'pesan' => 'Apakah kitchen set yang dibeli 2 tahun lalu masih dalam masa garansi? Ada kerusakan pada engsel kabinet.',
                'status_pesan' => 'baru',
                'dibaca_pada' => null,
                'dibalas_pada' => null,
                'created_at' => $now->copy()->subDays(1),
            ],
            [
                'nama_pengirim' => 'Dewi Lestari',
                'email_pengirim' => 'dewi@email.com',
                'no_whatsapp' => '628777888999',
                'subjek' => 'Pertanyaan Material',
                'pesan' => 'Apakah material MDF waterproof benar-benar tahan air? Saya khawatir dengan kelembaban dapur.',
                'status_pesan' => 'selesai',
                'dibaca_pada' => $now->copy()->subDays(10),
                'dibalas_pada' => $now->copy()->subDays(8),
                'created_at' => $now->copy()->subDays(12),
            ],
        ];

        foreach ($messages as $message) {
            DB::table('pesan_kontak')->insert($message);
        }

        $this->command->info('✅ Contact messages seeded: ' . count($messages) . ' messages');
    }
}